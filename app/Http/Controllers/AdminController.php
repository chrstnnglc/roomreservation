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
    public function reserve(Reservation $reserve) {
        $reserves = Reservation::all();
    	return view('admin.reserve', compact('reserves'));
    }

    public function rooms() {
        $rooms = Room::all();
    	return view('admin.rooms', compact('rooms'));
    }

    public function addform() {
        return view('admin.addroom');
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

    public function deleteroom(Request $request) {
        $room = Room::where('id', $request->id)->first();
        $room->delete();

        return view('admin.rooms', compact('rooms'));
        // $user = Auth::user();
        // $order = Order::where('customerid', $user->id)->where('paidstatus', false)->first();
        // $orderdetail = $order->orderdetails()->where('id', $request->id)->first();
        // $order->total = $order->total - ($orderdetail->priceeach * $orderdetail->quantity);
        // $order->save();
        // $orderdetail->delete();

        // return back();
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
