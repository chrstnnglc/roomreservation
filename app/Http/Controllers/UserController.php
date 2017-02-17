<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

	public function index()
    {
        $user = Auth::user();

        return view('profile.index', compact('user'));
    }
}
