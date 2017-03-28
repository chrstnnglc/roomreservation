<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;

class RoomsController extends Controller
{

    public function index() {
        $rooms = Room::all();
    	return view('rooms.index', compact('rooms'));
    }

    public function form() {
        return view('rooms.form');
    }

    public function showroom(Room $room) {
        return view('rooms.showroom', compact('room'));
    }

    public function addroom(Request $request) {
        $room = new Room;
        
        $room->name = $request->roomname;
        $room->rate = $request->rate;
        $room->capacity = $request->capacity;

        $room->save();

        $rooms = Room::all();

        return view('rooms.index', compact('rooms'));
    }

    public function editroom (Room $room) {
        return view('rooms.editroom', compact('room'));
    }

    public function updateroom (Request $request, Room $room) {

        $room->name = $request->roomname;
        $room->rate = $request->rate;
        $room->capacity = $request->capacity;

        $room->save();

        $url = 'rooms/' . $room->id;

        return redirect($url);

    }

    public function deleteroom(Request $request) {
        $room = Room::where('id', $request->id)->first();
        $room->delete();

        return redirect('rooms');
    }
}
