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
    	return view('yes');
    }

    public function register() {
    	return view('register');
    }
    public function user() {
        return view('user');
    }

    public function reserve_form() {
        return view('reserve_form');
    }

    public function reserve ()
    {
      return view('reserve');
    }
}
