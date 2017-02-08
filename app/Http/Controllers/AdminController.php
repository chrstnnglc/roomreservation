<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\Buy;
use App\Reservation;
use App\Equipment;
use App\Room;

class AdminController extends Controller
{
    public function reserve(Reservation $reserve) {
        $reserves = Reservation::all();
    	return view('admin.reserve', compact('reserves'));
    }

    public function room(Room $room) {
        $rooms = Room::all();
    	return view('admin.room', compact('rooms'));
    }

    public function equipment(Equipment $equipment) {
        $equipments = Equipment::all();
    	return view('admin.equipment', compact('equipments'));
    }

    public function user(User $user) {
        $users = User::all();
    	return view('admin.user', compact('users'));
    }
}
