<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Log;

class LogsController extends Controller
{
    public function index() {
        $logs = Log::all();
    	return view('logs.index', compact('logs'));
    }
}
