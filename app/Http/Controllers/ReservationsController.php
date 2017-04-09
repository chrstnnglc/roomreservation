<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Reservation;
use App\User;
use App\Room;
use App\Log;

class ReservationsController extends Controller
{
    //add, view, edit, delete
    public function __construct() {
        $this->middleware('auth');
    }

    public function index(Reservation $reserve) {
        $user = Auth::user();

        if ($user->users_role == 'admin' || $user->users_role == 'media' || $user->users_role == 'treasury') {
            $reserves = Reservation::with('room', 'user')->get();
            return view('reservations.index', compact('reserves'));
        } else {
            $reserves = Reservation::with('room', 'user')->where('user_id', $user->id)->get();
            return view('reservations.index', compact('reserves'));    
        }
    }

    public function form() {
        return view('reservations.form');
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
        $reserve->date_of_reservation = date("Y-m-d h:i:sa");
        $reserve->date_reserved = $request->date;
        $reserve->start_of_reserved = $request->starttime;
        $reserve->end_of_reserved = $request->endtime;
        if ((strtotime($request->endtime) - strtotime($request->starttime))/3600 < 0){
            $reserve->hours = (strtotime($request->endtime)+(12*60*60) - strtotime($request->starttime))/3600;
        }
        else{
            $reserve->hours = (strtotime($request->endtime) - strtotime($request->starttime))/3600;
        }
        $reserve->price = ($reserve->hours * $room->rate > 0)?$reserve->hours * $room->rate:$room->rate;
    	$reserve->reservations_status = 'not paid';
        
        $reserve->save();

        $log = new Log;

        $log->user_id = $request->user()->id;
        $log->date_of_reservation = date("Y-m-d h:i:sa");
        $log->remarks = "Add Reservation";

        $log->save();
        return redirect('reservations');
    }

    public function updatereservation(Request $request, Reservation $reserve) {
        $reserve->reservations_status = $request->status;
        
        $reserve->save();

        return redirect('reservations');
    }
}
