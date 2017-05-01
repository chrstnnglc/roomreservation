<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Reservation;
use App\User;
use App\Room;
use App\Log;
use App\Equipment;

class ReservationsController extends Controller
{
    //add, view, edit, delete
    public $message = "";
    public $isSuccess = 0;

    public function __construct() {
        $this->middleware('auth');

        $this->middleware('treasury', ['only' => ['updatereservation']]);
    }

    public function index(Reservation $reserve) {
        $user = Auth::user();

        if ($user->users_role == 'admin' || $user->users_role == 'media') {
            $reserves = Reservation::with('room', 'user')->get();

            foreach ($reserves as $reserve) {
                if ($reserve->status == 'not paid') {
                    if ((strtotime(date("Y-m-d H:i:s")) - strtotime($reserve->date_of_reservation)) > 259200) {
                        $log = new Log;

                        $log->user_id = $user->id;
                        $log->date_of_reservation = date("Y-m-d H:i:s");
                        $log->remarks = "Expired Reservation";

                        $log->save();

                        $reserve->delete();
                    }
                }
            }

            
            if ($this->message != "") {
                if ($isSuccess = $this->message);
                $success = $this->message;
                $this->message = "";

                return view('reservations.index', compact(''))
            } else {

                return view('reservations.index', compact('reserves'));
            }
        } elseif ($user->users_role == 'treasury') {
            $reserves = Reservation::with('room', 'user')->orderby('date_of_reservation')->get();
            return view('reservations.index', compact('reserves'));
            
        } else {
            $reserves = Reservation::with('room', 'user')->where('user_id', $user->id)->get();
            return view('reservations.index', compact('reserves'));    
        }
    }

    public function form() {
        $rooms = Room::all();
        $users = User::all();
        return view('reservations.form', compact('rooms', 'users'));
    }
    
    public function addreservation(Request $request) {

        $user = Auth::user();

        if ($user->users_role != 'user') {
            
            $this->validate($request, [
            
            'username' => "required|exists:users,username",
            'roomname' => "required|exists:rooms,name",
            'date' => "required|date|after_or_equal:" . date("Y-m-d"),
            'starttime' => "required",
            'endtime' => "required|greater_than_field:starttime"

            ]);

            $reserve = new Reservation;
            $user = User::where('username',$request->username)->first();
            $reserve->user_id = $user->id;

        } else {

            $this->validate($request, [
            
            'roomname' => "required|exists:rooms,name",
            'date' => "required|date|after_or_equal:" . date("Y-m-d"),
            'starttime' => "required",
            'endtime' => "required|greater_than_field:starttime"

            ]);

            $reserve = new Reservation;
            $reserve->user_id = $user->id;
        }

        $room = Room::where('name',$request->roomname)->first();
        $reserve->room_id = $room->id;
        $reserve->date_of_reservation = date("Y-m-d H:i:s");
        $reserve->date_reserved = $request->date;
        $reserve->start_of_reserved = date("H:i:s", strtotime($request->starttime) - 3600);
        $reserve->end_of_reserved = date("H:i:s", strtotime($request->endtime) + 1800);
        if ((strtotime($request->endtime) - strtotime($request->starttime))/3600 < 0) {
            $reserve->hours = (strtotime($request->endtime)+(12*60*60) - strtotime($request->starttime))/3600;
        } if ((strtotime($reserve->end_of_reserved) - strtotime($reserve->start_of_reserved))/3600 < 0){
            $reserve->hours = (strtotime($reserve->end_of_reserved)+(24*60*60) - strtotime($reserve->start_of_reserved))/3600;
        }
        else{
            $reserve->hours = (strtotime($reserve->end_of_reserved) - strtotime($reserve->start_of_reserved))/3600;
        }
        $reserve->price = ($reserve->hours * $room->rate > 0)?$reserve->hours * $room->rate:$room->rate;
        $equipment_reserved = Equipment::where('room_id', $room->id);

        foreach ($equipment_reserved as $equipment) {
            $reserve->price += $equipment->price;
        }

    	$reserve->reservations_status = 'not paid';
        
        $reserve_in_database1 = Reservation::where('room_id', $room->id)
            ->where('date_reserved', $request->date)
            ->where('start_of_reserved', '<=', $request->starttime)
            ->where('end_of_reserved', '>=', $request->endtime);

        $reserve_in_database2 = Reservation::where('room_id', $room->id)
            ->where('date_reserved', $request->date)
            ->where('start_of_reserved', '>=', $request->starttime)
            ->where('end_of_reserved', '<=', $request->endtime);

        $reserve_in_database3 = Reservation::where('room_id', $room->id)
            ->where('date_reserved', $request->date)
            ->where('start_of_reserved', '>=', $request->starttime)
            ->where('start_of_reserved', '<=', $request->endtime)
            ->where('end_of_reserved', '>=', $request->endtime);

        $reserve_in_database4 = Reservation::where('room_id', $room->id)
            ->where('date_reserved', $request->date)
            ->where('start_of_reserved', '<=', $request->starttime)
            ->where('end_of_reserved', '<=', $request->endtime)
            ->where('end_of_reserved', '>=', $request->starttime);

        if (!$reserve_in_database1->first() and !$reserve_in_database2->first() and !$reserve_in_database3->first() and !$reserve_in_database4->first()) {
            $reserve->save();

            $log = new Log;

            $log->user_id = $request->user()->id;
            $log->date_of_reservation = date("Y-m-d H:i:s");
            $log->remarks = "Add Reservation";

            $log->save();
        } else {

            $rooms = Room::all();
            $users = User::all();
            $conflict = 'The time and date is already taken.';
            return view('reservations.form', compact('rooms', 'users', 'conflict'));
            
        }
        
        $this->message = "Reservation successful!";
        return redirect('reservations');
    }

    public function updatereservation(Request $request, Reservation $reserve) {
        
        
        if ($request->or_number){
            $this->validate($request, [

                'or_number' => "numeric",
                
            ]);
            $reserve->or_number = $request->or_number;
            $reserve->reservations_status = "paid";

            $log = new Log;

            $log->user_id = $request->user()->id;
            $log->date_of_reservation = date("Y-m-d H:i:s");
            $log->remarks = "Paid Reservation";

            $log->save();
        }
        
        $reserve->save();

        return redirect('reservations');
    }

    public function deletereservation(Request $request) {
        $reservation = Reservation::where('id', $request->id)->first();
        $reservation->delete();

        $log = new Log;

        $log->user_id = $request->user()->id;
        $log->date_of_reservation = date("Y-m-d H:i:s");
        $log->remarks = "Cancel Reservation";

        $log->save();

        return redirect('reservations');
    }
}
