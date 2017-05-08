<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Reservation;
use App\User;
use App\Room;
use App\Log;
use App\Equipment;
use App\ReservationEquipment;

class ReservationsController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth');

        $this->middleware('treasury', ['only' => ['updatereservation']]);
    }

    public function index(Reservation $reserve, Request $request) {


        $sortable = array('room_id', 'user_id', 'date_reserved', 'date_of_reservation', 'reservations_status', 'date_paid', 'or_number');
        $sort = 'date_of_reservation';
        $ord = 'asc';

        if (in_array($request->sort, $sortable)) {
            $sort = $request->sort;
        }

        if ($request->ord != NULL) {
            $ord = $request->ord;
        }
        
        $user = Auth::user();

        if ($user->users_role == 'admin' || $user->users_role == 'media') {
            $reserves = Reservation::with('room', 'user')->orderBy($sort, $ord)->get();

            foreach ($reserves as $reserve) {
                if ($reserve->reservations_status == 'not paid') {
                    if (((strtotime(date("Y-m-d H:i:s"))) - strtotime($reserve->date_reserved)) > 259200) {
                        $reserve->reservations_status = 'expired';

                        $log = new Log;

                        $log->user_id = $user->id;
                        $log->date_of_reservation = date("Y-m-d H:i:s");
                        $log->remarks = "Expired Reservation";

                        $log->save();

                        $reserve->save();
                    }
                }
                elseif ($reserve->reservations_status == 'paid') {
                    if ((strtotime(date("Y-m-d"))) > strtotime($reserve->date_reserved)) {
                        $reserve->reservations_status = 'done';

                        $log = new Log;

                        $log->user_id = $user->id;
                        $log->date_of_reservation = date("Y-m-d H:i:s");
                        $log->remarks = "Done Reservation";

                        $log->save();

                        $reserve->save();
                    }
                }
            }

            $reserves = $reserves->where('reservations_status', '!=', 'done')->where('reservations_status', '!=', 'expired')->where('reservations_status', '!=', 'cancelled')->all();

            return view('reservations.index', compact('reserves', 'ord', 'sort'));

        } elseif ($user->users_role == 'treasury') {
            $reserves = Reservation::with('room', 'user')->orderBy($sort, $ord)->get();
            return view('reservations.index', compact('reserves', 'ord', 'sort'));
            
        } else {
            $reserves = Reservation::with('room', 'user')->orderBy($sort, $ord)->where('user_id', $user->id)->get();
            return view('reservations.index', compact('reserves', 'ord', 'sort'));    
        }
    }

    public function form() {
        $rooms = Room::all();
        $users = User::all();
        $equipment = Equipment::where('room_id', null)->where('condition','Working')->get();
        return view('reservations.form', compact('rooms', 'users', 'equipment'));
    }
    
    public function addreservation(Request $request) {

        $user = Auth::user();

        if ($user->users_role != 'user') {
            
            $this->validate($request, [
            
            'username' => "required|exists:users,username",
            'roomname' => "required|exists:rooms,name",
            'date' => "required|date|after_or_equal:" . date("Y-m-d H:i:s"),
            'starttime' => "required",
            'endtime' => "required|greater_than_field:starttime"

            ]);

            $reserve = new Reservation;
            $user = User::where('username',$request->username)->first();
            $reserve->user_id = $user->id;

        } else {

            $this->validate($request, [
            
            'roomname' => "required|exists:rooms,name",
            'date' => "required|date|after_or_equal:" . date("Y-m-d H:i:s"),
            'starttime' => "required",
            'endtime' => "required|greater_than_field:starttime",

            ]);

            $reserve = new Reservation;
            $reserve->user_id = $user->id;
        }

        $room = Room::where('name',$request->roomname)->first();
        $reserve->room_id = $room->id;
        $reserve->date_of_reservation = date("Y-m-d H:i:s");
        $reserve->date_reserved = $request->date;
        $reserve->start_of_reserved = date("H:i:s", strtotime($request->starttime));
        $reserve->end_of_reserved = date("H:i:s", strtotime($request->endtime));
        // if ((strtotime($request->endtime) - strtotime($request->starttime))/3600 < 0) {
        //$reserve->hours = (strtotime($request->endtime)+(12*60*60) - strtotime($request->starttime))/3600;
        // } if ((strtotime($reserve->end_of_reserved) - strtotime($reserve->start_of_reserved))/3600 < 0){
        $reserve->hours = (strtotime($reserve->end_of_reserved) - strtotime($reserve->start_of_reserved))/3600;
        // }
        // else{
        //     $reserve->hours = (strtotime($reserve->end_of_reserved) - strtotime($reserve->start_of_reserved))/3600;
        // }
        $reserve->price = $reserve->hours * $room->rate;
        $equipment_reserved = Equipment::where('room_id', $room->id)->where('condition','Working')->get();

        foreach ($equipment_reserved as $equipment) {
            $reserve->price += $equipment->price;
        }

    	$reserve->reservations_status = 'not paid';
        
        $reserve_in_database1 = Reservation::where('room_id', $room->id)
            ->where('date_reserved', $request->date)
            ->where('start_of_reserved', '<=', $request->starttime)
            ->where('end_of_reserved', '>=', $request->endtime)
            ->where('reservations_status', 'paid')
            ->orWhere(function ($query) use ($request, $room) {
                $query->where('room_id', $room->id)
                ->where('date_reserved', $request->date)
                ->where('start_of_reserved', '<=', $request->starttime)
                ->where('end_of_reserved', '>=', $request->endtime)
                ->where('reservations_status', 'not paid');                          
            });
        $reserve_in_database2 = Reservation::where('room_id', $room->id)
            ->where('date_reserved', $request->date)
            ->where('start_of_reserved', '>=', $request->starttime)
            ->where('end_of_reserved', '<=', $request->endtime)
            ->where('reservations_status', 'paid')
            ->orWhere(function ($query) use ($request, $room) {
                $query->where('room_id', $room->id)
                ->where('date_reserved', $request->date)
                ->where('start_of_reserved', '>=', $request->starttime)
                ->where('end_of_reserved', '<=', $request->endtime)
                ->where('reservations_status', 'not paid');                           
            });
        $reserve_in_database3 = Reservation::where('room_id', $room->id)
            ->where('date_reserved', $request->date)
            ->where('start_of_reserved', '>=', $request->starttime)
            ->where('start_of_reserved', '<=', $request->endtime)
            ->where('end_of_reserved', '>=', $request->endtime)
            ->where('reservations_status', 'paid')
            ->orWhere(function ($query) use ($request, $room) {
                $query->where('room_id', $room->id)
                ->where('date_reserved', $request->date)
                ->where('start_of_reserved', '>=', $request->starttime)
                ->where('start_of_reserved', '<=', $request->endtime)
                ->where('end_of_reserved', '>=', $request->endtime)
                ->where('reservations_status', 'not paid');                           
            });
        $reserve_in_database4 = Reservation::where('room_id', $room->id)
            ->where('date_reserved', $request->date)
            ->where('start_of_reserved', '<=', $request->starttime)
            ->where('end_of_reserved', '<=', $request->endtime)
            ->where('end_of_reserved', '>=', $request->starttime)
            ->where('reservations_status', 'paid')
            ->orWhere(function ($query) use ($request, $room) {
                $query->where('room_id', $room->id)
                ->where('date_reserved', $request->date)
                ->where('start_of_reserved', '<=', $request->starttime)
                ->where('end_of_reserved', '<=', $request->endtime)
                ->where('end_of_reserved', '>=', $request->starttime)
                ->where('reservations_status', 'not paid');                           
            });
        if (!$reserve_in_database1->first() and !$reserve_in_database2->first() and !$reserve_in_database3->first() and !$reserve_in_database4->first()) {
            $reserve->save();

            foreach($request['addlequip'] as $addl) {
                if (isset($addl)) {
                    $reserveeq = new ReservationEquipment;
                    $reserveeq->equipment_id = $addl;
                    
                    $equip = Equipment::where('id', $addl)->first();
                    $reserveeq->equipment_name = $equip->name;
                    $reserveeq->equipment_brand = $equip->brand;
                    $reserveeq->equipment_model = $equip->model;

                    $reserveeq->reservation_id = $reserve->id;
                    $reserveeq->save();
                    $reserve->equipment()->save($reserveeq);
                }
            }

            foreach($reserve->equipment as $r) {
                $req = Equipment::where('id', $r->equipment_id)->first();
                $reserve->price += $req->price;
            }

            $reserve->save();

            $log = new Log;

            $log->user_id = $request->user()->id;
            $log->date_of_reservation = date("Y-m-d H:i:s");
            $log->remarks = "Add Reservation";

            $log->save();
        } else {

            $rooms = Room::all();
            $users = User::all();
            $equipment = Equipment::where('room_id', null)->get();
            $conflict = 'The time and date is already taken.';
            return view('reservations.form', compact('rooms', 'users', 'equipment', 'conflict'));
            
        }
        
        return redirect('reservations');
    }

    public function updatereservation(Request $request, Reservation $reserve) {
        
        
        if ($request->or_number){
            $this->validate($request, [

                'or_number' => "alpha_num|max:10",
                
            ]);
            $reserve->or_number = $request->or_number;
            $reserve->reservations_status = "paid";
            $reserve->date_paid = date("Y-m-d H:i:s");

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
        $user = User::where('users_role','admin')->first();
        $reservation = Reservation::where('id', $request->id)->first();
        $reservation->reservations_status = 'cancelled';
        $reservation->user_id = $user->id;

        $log = new Log;

        $log->user_id = $request->user()->id;
        $log->date_of_reservation = date("Y-m-d H:i:s");
        $log->remarks = "Cancel Reservation";

        $log->save();

        $reservation->save();

        return redirect('reservations');
    }
}
