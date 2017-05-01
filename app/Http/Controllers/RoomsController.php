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
        $rooms = Room::all()->sortby('name');
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
        $notice['message'] = 'Successfully added room!';
        $notice['color'] = 'green';
        return view('rooms.index', compact('rooms', 'notice'));
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

        $room = Room::withCount('reservation')->withCount('equipment')->where('id',$request->id)->first();
        
        if ($room->reservation_count != 0 || $room->equipment_count != 0) {
            $rooms = Room::all();
            $notice['message'] = 'Cannot delete! Room has dependent entries in the database.';
            $notice['color'] = 'red';

        } else {
            $room->delete();
            $notice['message'] = 'Successfully deleted room!';
            $notice['color'] = 'green';
        }
        $rooms = Room::all();
        return view('rooms.index', compact('rooms', 'notice'));
    }
}
