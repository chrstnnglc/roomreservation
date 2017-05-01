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
    public function __construct() {
        $this->middleware('auth');
    }

    public function index(Reservation $reserve) {
        $user = Auth::user();

        if ($user->users_role == 'admin' || $user->users_role == 'media') {
            $reserves = Reservation::with('room', 'user')->get();
            return view('reservations.index', compact('reserves'));

        } elseif ($user->users_role == 'treasury') {
            $reserves = Reservation::with('room', 'user')->orderby('reservations_status', 'desc')->get();
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

        $reserve = new Reservation;

        if ($user->users_role != 'user') {
            $user = User::where('username',$request->username)->first();
            $reserve->user_id = $user->id;
        } else {
            $reserve->user_id = $user->id;
        }
        $room = Room::where('name',$request->roomname)->first();
        $reserve->room_id = $room->id;
        $reserve->date_of_reservation = date("Y-m-d H:i:sa");
        $reserve->date_reserved = $request->date;
        $reserve->start_of_reserved = date("H:i:s", strtotime($request->starttime) - 3600);
        $reserve->end_of_reserved = date("H:i:s", strtotime($request->endtime) + 1800);
        if ((strtotime($request->endtime) - strtotime($request->starttime))/3600 < 0){
            $reserve->hours = (strtotime($request->endtime)+(12*60*60) - strtotime($request->starttime))/3600;
        }
        else{
            $reserve->hours = (strtotime($request->endtime) - strtotime($request->starttime))/3600;
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
            $log->date_of_reservation = date("Y-m-d H:i:sa");
            $log->remarks = "Add Reservation";

            $log->save();
        }
        return redirect('reservations');
    }

    public function updatereservation(Request $request, Reservation $reserve) {
        if ($request->status){
            $reserve->reservations_status = $request->status;
        }
        if ($request->or_number and $request->status == "paid"){
            $reserve->or_number = $request->or_number;
        }
        
        $reserve->save();

        return redirect('reservations');
    }

    public function deletereservation(Request $request) {
        $reservation = Reservation::where('id', $request->id)->first();
        $reservation->delete();

        $log = new Log;

        $log->user_id = $request->user()->id;
        $log->date_of_reservation = date("Y-m-d H:i:sa");
        $log->remarks = "Cancel Reservation";

        $log->save();

        return redirect('reservations');
    }
}
