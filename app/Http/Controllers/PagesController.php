<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function index() {
     return view('index');
    }

    public function login() {
        if (Auth::check()) {
            return redirect('/success');
        } else {
            return view('login');
        }
    }

    public function success(Request $request) {
        // return $request->user();
        if ($request->user()->users_role == "admin") {
            return redirect('admin/reservations');
        } else if ($request->user()->users_role == "media") {
            return redirect('media/reservations');
        } else if ($request->user()->users_role == "treasury") {
            return redirect('treasury/reservations');
        } else if ($request->user()->users_role == "user") {
            return redirect('user/reservations');
        } else {
            return redirect('login');
        }
    }

    public function register() {
    	return view('register');
    }
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
