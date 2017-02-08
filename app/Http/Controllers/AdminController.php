<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function reserve()
    {
    	return view('admin.reserve');
    }

    public function room() {
    	return view('admin.room');
    }

    public function equipment() {
    	return view('admin.room');
    }

    public function user() {
    	return view('admin.user');
    }
}
