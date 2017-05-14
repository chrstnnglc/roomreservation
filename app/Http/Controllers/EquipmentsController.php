<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment;
use App\Room;
use App\User;

class EquipmentsController extends Controller
{
    public function __construct() {
        $this->middleware('adminmedia', ['only' => 'form', 'showequipment', 'addequipment', 'editequipment', 'updateequipment', 'deleteequipment']);
    }

   public function index(Request $request) {
        $sortable = array('name', 'brand', 'model', 'price', 'condition', 'room_id');
        $sort = 'name';
        $ord = 'asc';

        if (in_array($request->sort, $sortable)) {
            $sort = $request->sort;
        }

        if ($request->ord != NULL) {
            $ord = $request->ord;
        }

        $equipments = Equipment::with('room')->orderby($sort, $ord)->get();

        if ($request->session()->has('message') && $request->session()->has('color')) {
            $notice['message'] = session('message');
            $notice['color'] = session('color');
            return view('equipment.index', compact('equipments', 'sort', 'ord', 'notice'));
        } else {
    	    return view('equipment.index', compact('equipments', 'sort', 'ord'));
        }
        
    }

    public function form() {
        $rooms = Room::all();
        return view('equipment.form', compact('rooms'));
    }

    public function showequipment(Request $request, Equipment $equipment) {
        if ($request->session()->has('message') && $request->session()->has('color')) {
            $notice['message'] = session('message');
            $notice['color'] = session('color');
            return view('equipment.showequipment', compact('equipment', 'notice'));
        } else {
    	    return view('equipment.showequipment', compact('equipment'));
        }
    }

    public function addequipment(Request $request) {
        
        $this->validate($request, [

            'equipment' => 'required|max:255',
            'brand' => 'required|max:255',
            'model' => 'required|max:255',
            'price' => 'required|numeric|min:0|not_in:0',
            'condition' => 'required',
            
        ]);
        
        $equipment = new Equipment;
        
        $equipment->name = $request->equipment;
        $equipment->brand = $request->brand;
        $equipment->model = $request->model;
        $equipment->price = $request->price;
        $equipment->condition = $request->condition;

        if ($request->room != ""){
            $room = Room::where('name', $request->room)->first();
            $equipment->room_id = $room->id;
        }

        $equipment->save();


        $request->session()->flash('message', 'Successfully added equipment!');
        $request->session()->flash('color', 'green');
        return redirect('/equipment');
    }

    public function editequipment(Equipment $equipment) {
        $rooms = Room::all();
        return view('equipment.editequipment', compact('equipment', 'rooms'));
    }

    public function updateequipment(Request $request, Equipment $equipment) {

        $this->validate($request, [

            'equipment' => 'required|max:255',
            'brand' => 'required|max:255',
            'model' => 'required|max:255',
            'price' => 'required|numeric|min:0|not_in:0',
            'condition' => 'required',

        ]);

        $equipment->name = $request->equipment;
        $equipment->brand = $request->brand;
        $equipment->model = $request->model;
        $equipment->price = $request->price;
        $equipment->condition = $request->condition;
        
        if ($request->room != ""){
            $room = Room::where('name', $request->room)->first();
            $equipment->room_id = $room->id;
        }

        $equipment->save();

        $url = 'equipment/' . $equipment->id;

        $request->session()->flash('message', 'Successfully update equipment!');
        $request->session()->flash('color', 'green');
        return redirect($url);
    }

    // public function deleteequipment(Request $request) {
    //     $equipment = Equipment::where('id', $request->id)->first();
    //     $equipment->delete();
    //     $request->session()->flash('message', 'Successfully deleted equipment!');
    //     $request->session()->flash('color', 'green');
    //     return redirect('equipment');
    // }
}
