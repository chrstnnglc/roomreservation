<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Reservation;

class PagesController extends Controller
{
    public function index() {
        $reserves = Reservation::with('room', 'user')->get();
        return view('home',compact('reserves'));
    }

    //
    public function user() {
        return view('user.user');
    }

    public function reserve_form() {
        return view('user.reserve_form');
    }

    public function reserve (Reservation $reserves)
    {
      return view('user.reserve', compact('reserves'));
    }

    public function edit_user() {
        return view('user.edit_user');
    }
    public function editroom() {
        return view('editroom');
    }
}
