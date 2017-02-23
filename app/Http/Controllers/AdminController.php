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

class AdminController extends Controller
{
    public function reservations(Reservation $reserve) {
        $reserves = Reservation::all();
    	return view('admin.reserve', compact('reserves'));
    }
    public function reserve_form(Reservation $reserve) {
        $reserves = Reservation::all();
        return view('admin.reserve_form', compact('reserve'));
    }
    public function addreservation(Request $request) {
        $reserve = new Reservation;
        
        $reserve->name = $request->roomname;
        $reserve->date = $request->rate;
        $reserve->starttime = $request->starttime;
        $reserve->endtime = $request->endtime;

        $reserve->save();

        $reserves = Reservation::all();
        return view('admin.reserve', compact('reserves'));
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

}
