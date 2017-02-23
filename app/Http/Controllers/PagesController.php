<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function login ()
    {
    	return view('login');
    }

    public function yes() {
    	return view('user.yes');
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

    public function reserve ()
    {
      return view('user.reserve');
    }

    public function edit_user() {
        return view('user.edit_user');
    }
    public function editroom() {
        return view('editroom');
    }
}
