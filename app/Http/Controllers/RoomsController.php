<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Room;
use App\Equipment;

class RoomsController extends Controller
{
    public function __construct() {
        $this->middleware('adminmedia', ['only' => 'form', 'showroom', 'addroom', 'editroom', 'updateroom', 'deleteroom']);
    }

    public function index(Request $request) {
        $sortable = array('name', 'rate', 'capacity');
        $sort = 'name';
        $ord = 'asc';

        if (in_array($request->sort, $sortable)) {
            $sort = $request->sort;
        }

        if ($request->ord != NULL) {
            $ord = $request->ord;
        }
        
        $rooms = DB::table('rooms')->orderBy($sort, $ord)->get();

        if ($request->session()->has('message') && $request->session()->has('color')) {
            $notice['message'] = session('message');
            $notice['color'] = session('color');
            return view('rooms.index', compact('rooms', 'sort', 'ord', 'notice'));
        } else {
    	    return view('rooms.index', compact('rooms', 'sort', 'ord'));
        }
    }

    public function form() {
        return view('rooms.form');
    }

    public function showroom(Room $room, Request $request) {

        if ($request->session()->has('message') && $request->session()->has('color')) {
            $notice['message'] = session('message');
            $notice['color'] = session('color');
            return view('rooms.showroom', compact('room', 'notice'));
        } else {
    	    return view('rooms.showroom', compact('room'));
        }
    }

    public function addroom(Request $request) {
        
        $this->validate($request, [

            'roomname' => 'required|max:255|unique:rooms,name',
            'capacity' => 'required|integer|min:1',
        
        ]);
        
        $room = new Room;
        
        $room->name = $request->roomname;
        $room->rate = 0;
        $room->capacity = $request->capacity;

        $room->save();
        $rooms = Room::all();
        $request->session()->flash('message', 'Successfully added room!');
        $request->session()->flash('color', 'green');
        return redirect('/rooms');
    }

    public function editroom (Room $room) {
        return view('rooms.editroom', compact('room'));
    }

    public function updateroom (Request $request, Room $room) {

        $this->validate($request, [

            'roomname' => [
                'required',
                'max:255',
            ],
            'capacity' => 'required|integer|min:1',
        
        ]);

        $room->name = $request->roomname;
        $room->capacity = $request->capacity;

        $room->save();

        $url = 'rooms/' . $room->id;

        $request->session()->flash('message', 'Successfully updated room!');
        $request->session()->flash('color', 'green');
        return redirect($url);

    }

    public function deleteroom(Request $request) {

        $room = Room::withCount('reservation')->withCount('equipment')->where('id',$request->id)->first();
        
        if ($room->reservation_count != 0 || $room->equipment_count != 0) {
            $rooms = Room::all();
            $request->session()->flash('message', 'Cannot delete room with dependencies!');
            $request->session()->flash('color', 'red');
        } else {
            $room->delete();
            $request->session()->flash('message', 'Successfully deleted room!');
            $request->session()->flash('color', 'green');
        }
        $rooms = Room::all();
        return redirect('/rooms');
    }
}
