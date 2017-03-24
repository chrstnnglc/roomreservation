<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

	public function index()
    {
        $user = Auth::user();

        return view('reservations', compact('user'));
    }

    public function userslist(User $user) {
        $users = User::all();
    	return view('user', compact('users'));
    }

    public function showuser(User $user) {
        return view('showuser', compact('user'));
    }

    public function adduser(Request $request) {
        $user = new User;
        
        $user->username = $request->username;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->mobile = $request->mobile;
        $user->affiliation = $request->affiliation;
        $user->users_role = $request->users_role;

        $user->save();

        $users = User::all();
        return view('user', compact('users'));
    }

    public function edituser(User $user) {
        return view('edituser', compact('user'));
    }

    public function updateuser(Request $request, User $user) {

        $user->username = $request->username;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->mobile = $request->mobile;
        $user->affiliation = $request->affiliation;
        $user->users_role = $request->users_role;

        $user->save();

        $url = 'user/' . $user->id;

        return redirect($url);
    }

    public function deleteuser(Request $request) {
        $user = User::where('id', $request->id)->first();
        $user->delete();

        return redirect('user');
    }
}
