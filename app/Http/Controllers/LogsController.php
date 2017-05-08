<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Log;

class LogsController extends Controller
{
    public function index(Request $request) {
        $sortable = array('id', 'user_id', 'date_of_reservation');
        $sort = 'id';
        $ord = 'desc';

        if (in_array($request->sort, $sortable)) {
            $sort = $request->sort;
        }

        if ($request->ord != NULL) {
            $ord = $request->ord;
        }

        $logs = Log::orderby($sort, $ord)->get();
    	return view('logs.index', compact('logs', 'sort', 'ord'));
    }
}
