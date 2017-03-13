<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Product;
use App\Buy;
use App\Reservation;
use App\Equipment;
use App\Room;

class MediaController extends Controller
{
    public function reservations(Reservation $reserve) {
        $reserves = Reservation::all();
    	return view('media.reserve', compact('reserves'));
    }
    public function reserve_form(Reservation $reserve) {
        $reserves = Reservation::all();
        return view('media.reserve_form', compact('reserve'));
    }
    public function addreservation(Request $request) {
        $reserve = new Reservation;
        
        $reserve->name = $request->roomname;
        $reserve->date = $request->rate;
        $reserve->starttime = $request->starttime;
        $reserve->endtime = $request->endtime;

        $reserve->save();

        $reserves = Reservation::all();
        return view('media.reserve_form', compact('reserves'));
    }

    public function rooms() {
        $rooms = Room::all();
    	return view('media.rooms', compact('rooms'));
    }

    public function showroom(Room $room) {
        return view('media.showroom', compact('room'));
    }

    public function addroom(Request $request) {
        $room = new Room;
        
        $room->name = $request->roomname;
        $room->rate = $request->rate;
        $room->capacity = $request->capacity;

        $room->save();

        $rooms = Room::all();
        return view('media.rooms', compact('rooms'));
    }

    public function editroom (Room $room) {
        return view('media.editroom', compact('room'));
    }

    public function updateroom (Request $request, Room $room) {

        $room->name = $request->roomname;
        $room->rate = $request->rate;
        $room->capacity = $request->capacity;

        $room->save();

        $url = 'media/rooms/' . $room->id;

        return redirect($url);

    }

    public function deleteroom(Request $request) {
        $room = Room::where('id', $request->id)->first();
        $room->delete();

        return redirect('media/rooms');
    }


    public function equipment() {
        $equipments = Equipment::all();
        return view('media.equipments', compact('equipments'));
    }

    public function showequipment(Equipment $equipment) {
        return view('media.showequipment', compact('equipment'));
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
        return view('media.equipments', compact('equipments'));
    }

    public function editequipment(Equipment $equipment) {
        return view('media.editequipment', compact('equipment'));
    }

    public function updateequipment(Request $request, Equipment $equipment) {

        $equipment->name = $request->equipment;
        $equipment->brand = $request->brand;
        $equipment->model = $request->model;
        $equipment->price = $request->price;
        $equipment->condition = $request->condition;
        $equipment->room_id = $request->room_id;

        $equipment->save();

        $url = 'media/equipments/' . $equipment->id;

        return redirect($url);
    }

    public function deleteequipment(Request $request) {
        $equipment = Equipment::where('id', $request->id)->first();
        $equipment->delete();

        return redirect('media/equipments');
    }

    public function user(User $user) {
        $users = User::all();
    	return view('media.user', compact('users'));
    }

    public function showuser(User $user) {
        return view('media.showuser', compact('user'));
    }

    public function adduser(Request $request) {
        $user = new User;
        
        $user->username = $request->username;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->mobile = $request->mobile;
        $user->affiliation = $request->affiliation;
        $user->users_role = $request->users_role;

        $user->save();

        $users = User::all();
        return view('media.user', compact('users'));
    }

    public function edituser(User $user) {
        return view('media.edituser', compact('user'));
    }

    public function updateuser(Request $request, User $user) {

        $user->username = $request->username;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->mobile = $request->mobile;
        $user->affiliation = $request->affiliation;
        $user->users_role = $request->users_role;

        $user->save();

        $url = 'media/user/' . $user->id;

        return redirect($url);
    }

    public function deleteuser(Request $request) {
        $user = User::where('id', $request->id)->first();
        $user->delete();

        return redirect('media/user');
    }
}
