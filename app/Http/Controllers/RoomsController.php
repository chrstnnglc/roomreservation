<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Room;

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
    	return view('rooms.index', compact('rooms', 'sort', 'ord'));
    }

    public function form() {
        return view('rooms.form');
    }

    public function showroom(Room $room) {
        return view('rooms.showroom', compact('room'));
    }

    public function addroom(Request $request) {
        
        $this->validate($request, [

            'roomname' => 'required|max:255|unique:rooms,name',
            'rate' => 'required|integer|min:1',
            'capacity' => 'required|integer|min:1',
        
        ]);
        
        $room = new Room;
        
        $room->name = $request->roomname;
        $room->rate = $request->rate;
        $room->capacity = $request->capacity;

        $room->save();
        $rooms = Room::all();
        // $notice['message'] = 'Successfully added room!';
        // $notice['color'] = 'green';
        // return view('rooms.index', compact('rooms', 'notice'));
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
