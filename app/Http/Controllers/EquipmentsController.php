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

   public function index() {
        $equipments = Equipment::with('room')->orderby('room_id')->get();
        return view('equipment.index', compact('equipments'));
    }

    public function form() {
        $rooms = Room::all();
        return view('equipment.form', compact('rooms'));
    }

    public function showequipment(Equipment $equipment) {
        return view('equipment.showequipment', compact('equipment'));
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

        $equipments = Equipment::all();
        return view('equipment.index', compact('equipments'));
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
            'room' => 'exists:rooms,name',

        ]);

        $equipment->name = $request->equipment;
        $equipment->brand = $request->brand;
        $equipment->model = $request->model;
        $equipment->price = $request->price;
        $equipment->condition = $request->condition;
        
        $room = Room::where('name', $request->room)->first();
        $equipment->room_id = $room->id;

        $equipment->save();

        $url = 'equipment/' . $equipment->id;

        return redirect($url);
    }

    public function deleteequipment(Request $request) {
        $equipment = Equipment::where('id', $request->id)->first();
        $equipment->delete();

        return redirect('equipment');
    }
}
