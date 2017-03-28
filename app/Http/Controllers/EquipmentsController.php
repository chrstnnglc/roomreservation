<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment;
use App\Room;
use App\User;

class EquipmentsController extends Controller
{
   public function index() {
        $equipments = Equipment::all();
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

            'equipment' => 'required|alphaNum|max:255',
            'brand' => 'required|max:255',
            'model' => 'required|max:255',
            'price' => 'required|numeric|min:0|not_in:0',
            'condition' => 'required|alpha',
            'room' => 'required|exists:rooms,name',

        ]);
        
        $equipment = new Equipment;
        
        $equipment->name = $request->equipment;
        $equipment->brand = $request->brand;
        $equipment->model = $request->model;
        $equipment->price = $request->price;
        $equipment->condition = $request->condition;

        $room = Room::where('name', $request->room)->first();
        $equipment->room_id = $room->id;

        $equipment->save();

        $equipments = Equipment::all();
        return view('equipment.index', compact('equipments'));
    }

    public function editequipment(Equipment $equipment) {
        return view('equipment.editequipment', compact('equipment'));
    }

    public function updateequipment(Request $request, Equipment $equipment) {

        $equipment->name = $request->equipment;
        $equipment->brand = $request->brand;
        $equipment->model = $request->model;
        $equipment->price = $request->price;
        $equipment->condition = $request->condition;
        $equipment->room_id = $request->room_id;

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
