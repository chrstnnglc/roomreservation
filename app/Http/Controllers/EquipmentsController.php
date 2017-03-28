<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment;

class EquipmentsController extends Controller
{
   public function index() {
        $equipments = Equipment::all();
        return view('equipment.index', compact('equipments'));
    }

    public function form() {
        return view('equipment.form');
    }

    public function showequipment(Equipment $equipment) {
        return view('equipment.showequipment', compact('equipment'));
    }

    public function addequipment(Request $request) {
        $equipment = new Equipment;
        
        $equipment->name = $request->equipment;
        $equipment->brand = $request->brand;
        $equipment->model = $request->model;
        $equipment->price = $request->price;
        $equipment->condition = $request->condition;
        $equipment->room_id = $request->room_id;

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
