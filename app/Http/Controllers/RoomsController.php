<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;

class RoomsController extends Controller
{
    public function __construct() {
        $this->middleware('adminmedia');
    }

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
        
        $this->validate($request, [

            'roomname' => 'required|alphaNum|max:255|unique:rooms,name',
            'rate' => 'required|integer|min:1',
            'capacity' => 'required|integer|min:1',
        
        ]);
        
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

        $this->validate($request, [

            'roomname' => [
                'required',
                'alphaNum',
                'max:255',
                Rule::unique('rooms')->ignore($user->id),
            ],
            'rate' => 'required|integer|min:1',
            'capacity' => 'required|integer|min:1',
        
        ]);

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
