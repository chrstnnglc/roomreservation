<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Auth;
use Carbon\Carbon;
use App\User;
use App\Product;
use App\Buy;
use App\Reservation;
use App\Equipment;
use App\Room;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function reservations(Reservation $reserve) {
        $reserves = Reservation::all();
    	return view('admin.reserve', compact('reserves'));
    }
    public function reserve_form(Reservation $reserve) {
        // $reserves = Reservation::all();
        return view('admin.reserve_form');
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
        return redirect('admin/reservations');
    }

    public function rooms() {
        $rooms = Room::all();
    	return view('admin.rooms', compact('rooms'));
    }

    public function showroom(Room $room) {
        return view('admin.showroom', compact('room'));
    }

    public function addroom(Request $request) {
        $room = new Room;
        
        $room->name = $request->roomname;
        $room->rate = $request->rate;
        $room->capacity = $request->capacity;

        $room->save();

        $rooms = Room::all();
        return view('admin.rooms', compact('rooms'));
    }

    public function editroom (Room $room) {
        return view('admin.editroom', compact('room'));
    }

    public function updateroom (Request $request, Room $room) {

        $room->name = $request->roomname;
        $room->rate = $request->rate;
        $room->capacity = $request->capacity;

        $room->save();

        $url = 'admin/rooms/' . $room->id;

        return redirect($url);

    }

    public function deleteroom(Request $request) {
        $room = Room::where('id', $request->id)->first();
        $room->delete();

        return redirect('admin/rooms');
    }


    public function equipment() {
        $equipments = Equipment::all();
        return view('admin.equipments', compact('equipments'));
    }

    public function showequipment(Equipment $equipment) {
        return view('admin.showequipment', compact('equipment'));
    }

    public function addequipment(Request $request) {
        $equipment = new Equipment;
        
        $equipment->name = $request->equipment;
        $equipment->brand = $request->brand;
        $equipment->model = $request->model;
        $equipment->price = $request->price;
        $equipment->condition = $request->condition;
        $equipment->room_id = $request->room_id;

        $equipment->save();

        $equipments = Equipment::all();
        return view('admin.equipments', compact('equipments'));
    }

    public function editequipment(Equipment $equipment) {
        return view('admin.editequipment', compact('equipment'));
    }

    public function updateequipment(Request $request, Equipment $equipment) {

        $equipment->name = $request->equipment;
        $equipment->brand = $request->brand;
        $equipment->model = $request->model;
        $equipment->price = $request->price;
        $equipment->condition = $request->condition;
        $equipment->room_id = $request->room_id;

        $equipment->save();

        $url = 'admin/equipments/' . $equipment->id;

        return redirect($url);
    }

    public function deleteequipment(Request $request) {
        $equipment = Equipment::where('id', $request->id)->first();
        $equipment->delete();

        return redirect('admin/equipments');
    }

    public function user(User $user) {
        $users = User::all();
    	return view('admin.user', compact('users'));
    }

    public function showuser(User $user) {
        return view('admin.showuser', compact('user'));
    }

    public function adduser(Request $request) {
        $user = new User;
        
        $user->username = $request->username;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->mobile = $request->mobile;
        $user->affiliation = $request->affiliation;
        $user->users_role = $request->users_role;

        $user->save();

        $users = User::all();
        return view('admin.user', compact('users'));
    }

    public function edituser(User $user) {
        return view('admin.edituser', compact('user'));
    }

    public function updateuser(Request $request, User $user) {

        $user->username = $request->username;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->mobile = $request->mobile;
        $user->affiliation = $request->affiliation;
        $user->users_role = $request->users_role;

        $user->save();

        $url = 'admin/user/' . $user->id;

        return redirect($url);
    }

    public function deleteuser(Request $request) {
        $user = User::where('id', $request->id)->first();
        $user->delete();

        return redirect('admin/user');
    }

}
