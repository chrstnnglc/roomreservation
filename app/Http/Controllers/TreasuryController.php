<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;

class TreasuryController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function reservations(Reservation $reserve) {
        $reserves = Reservation::all();
    	return view('treasury.reserve', compact('reserves'));
    }

    // public function showreservations(Reservation $reserve) {
    //     return view('treasury.reserve_form', compact('reserve'));
    // }

    public function updatereservation(Request $request, Reservation $reserve) {
        $reserve->reservations_status = $request->status;
        
        $reserve->save();

        return redirect('treasury/reservations');
    }
}
