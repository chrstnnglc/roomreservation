<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\User;
use App\Reservation;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('adminmedia', ['only' => ['user_form', 'userslist', 'showuser', 'adduser', 'deleteuser', 'userhistory']]);
    }

    public function profile() {
        $user = Auth::user();

        return view('user.profile', compact('user'));
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
            'password' => 'required|alpha_num|min:6|confirmed',
            'password_confirmation' => 'required',
            'mobile' => 'nullable|digits:11',
            'affiliation' => 'nullable|alpha_num|max:255',
            'users_role' => [
                'required',
                Rule::in(['admin', 'media', 'treasury', 'user']),
            ],
            
        ]);

        $users = User::all();
        $user = new User;

        $user->id = $users->last()->id + 1;
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
            'password' => 'required|alpha_num|min:6|confirmed',
            'password_confirmation' => 'required',
            'mobile' => 'nullable|digits:11',
            'affiliation' => 'nullable|alpha_num|max:255',
            'users_role' => [
                'required',
                Rule::in(['admin', 'media', 'treasury', 'user']),
            ],
            
        ]);

        if (Auth::user()->users_role != "admin" && Auth::user()->users_role != "media") {
            if (bcrypt($request->password) != $user->password) {
                // return [$user, 'error' => 'Current password is incorrect!'];
                return view('user.edituser', ['user' => $user, 'error' => 'Current password is incorrect!']); 
            }
        }
        $user->username = $request->username;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->mobile = $request->mobile;
        $user->affiliation = $request->affiliation;
        $user->users_role = $request->users_role;

        $user->save();

        if ($user->users_role == 'user') {
            $url = 'user/profile';
            return redirect($url);
        } else {
            $url = 'user/' . $user->id;
            return redirect($url);
        }
    }

    public function deleteuser(Request $request) {
        $user = User::where('id', $request->id)->first();
        $user->delete();

        return redirect('user');
    }

    public function viewhistory(Request $request) {
        $user = Auth::user();

        $reserves = Reservation::where('user_id', $user->id)->where('reservations_status', 'paid')->orderby('date_of_reservation', 'desc')->get();
        
        return view('user.history', compact('reserves'));
    }

    public function userhistory(User $user) {
        $reserves = Reservation::where('user_id', $user->id)->where('reservations_status', 'paid')->orderby('date_of_reservation', 'desc')->get();

        return view('user.userhistory', compact('reserves'));
    }
}
