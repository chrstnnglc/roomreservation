<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
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

    public function profile() {
        $user = Auth::user();

        return view('profile.index', compact('user'));
    }

    public function user_form(User $user) {
        $users = User::all();
        return view('user.users_form', compact('users'));
    }

    public function userslist(User $user) {
        $users = User::all();
    	return view('user.userslist', compact('users'));
    }

    public function showuser(User $user) {
        return view('user.showuser', compact('user'));
    }

    public function adduser(Request $request) {
        $this->validate($request, [
            'username' => 'required|alpha_num|max:255|unique:users',
            'firstname' => 'nullable|alpha_num|max:255',
            'lastname' => 'nullable|alpha_num|max:255',
            'email' => 'nullable|email',
            'password' => 'required|alpha_num|min:6',
            'password_confirmation' => 'required|confirmed',
            'mobile' => 'nullable|numeric|max:11',
            'affiliation' => 'nullable|alpha_num|max:255',
            'users_role' => [
                'required',
                Rule::in(['admin', 'media', 'treasury', 'user']),
            ],
            
        ]);

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
        return view('user.userslist', compact('users'));
    }

    public function edituser(User $user) {
        return view('user.edituser', compact('user'));
    }

    public function updateuser(Request $request, User $user) {
        
        $this->validate($request, [

            'username' => [
                'required',
                'alpha_num',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'firstname' => 'nullable|alpha_num|max:255',
            'lastname' => 'nullable|alpha_num|max:255',
            'email' => [
                'nullable',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'required|alpha_num|min:6',
            'mobile' => 'nullable|numeric|max:11',
            'affiliation' => 'nullable|alpha_num|max:255',
            'users_role' => [
                'required',
                Rule::in(['admin', 'media', 'treasury', 'user']),
            ],
            
        ]);

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
