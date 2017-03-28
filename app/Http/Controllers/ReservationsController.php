<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;

class ReservationsController extends Controller
{
    //add, view, edit, delete
    public function __construct() {
        $this->middleware('auth');
    }

    public function index(Reservation $reserve) {
        $reserves = Reservation::all();
        /* If regular user: show only user's reservations
            Else, show all reservations */
            
    	return view('reservations.index', compact('reserves'));
    }

    public function form() {
        return view('reservations.form');
    }
    
    public function addreservation(Request $request) {
        $reserve = new Reservation;
        $user = User::where('username',$request->username)->first();
        $reserve->user_id = $user->id;
        $room = Room::where('name',$request->roomname)->first();
        $reserve->room_id = $room->id;
        $reserve->date_of_reservation = date("Y-m-d h:i:sa");
        $reserve->date_reserved = $request->date;
        $reserve->start_of_reserved = $request->starttime;
        $reserve->end_of_reserved = $request->endtime;
        $reserve->hours = (strtotime($request->endtime) - strtotime($request->starttime))/3600;
        $reserve->price = ($reserve->hours * $room->rate > 0)?$reserve->hours * $room->rate:$room->rate;
    	$reserve->reservations_status = 'not paid';
        
        $reserve->save();
        return redirect('reservations');
    }
}
