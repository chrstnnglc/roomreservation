<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Reservation;
use Validator;

class UserController extends Controller
{
    // private $notice = ['color' => '', 'message' => ''];

    public function __construct() {
        // $this->notice = ['color' => 'hello', 'message' => ''];
        $this->middleware('auth');
        $this->middleware('adminmedia', ['only' => ['user_form', 'userslist', 'showuser', 'adduser', 'deleteuser', 'userhistory']]);
    }

    public function profile(Request $request) {
        $user = Auth::user();

        if ($request->session()->has('message') && $request->session()->has('color')) {
            $notice['message'] = session('message');
            $notice['color'] = session('color');
             return view('user.profile', compact('user', 'notice'));
        } else {
             return view('user.profile', compact('user'));
        }
    }

    public function user_form(User $user) {
        $users = User::all();
        return view('user.users_form', compact('users'));
    }

    public function userslist(Request $request, User $user) {
        $sortable = array('username', 'firstname', 'lastname', 'email', 'mobile', 'affiliation', 'users_role');
        $sort = 'username';
        $ord = 'ord';

        if (in_array($request->sort, $sortable)) {
            $sort = $request->sort;
        }

        if ($request->ord != NULL) {
            $ord = $request->ord;
        }
        
        $users = User::where('users_role', '!=', 'trash')->orderby($sort, $ord)->get();

        if ($request->session()->has('message') && $request->session()->has('color')) {
            $notice['message'] = session('message');
            $notice['color'] = session('color');
            return view('user.userslist', compact('users', 'sort', 'ord', 'notice'));
        } else {
            return view('user.userslist', compact('users', 'sort', 'ord'));
        }

    }

    public function showuser(Request $request, User $user) {
        if ($request->session()->has('message') && $request->session()->has('color')) {
            $notice['message'] = session('message');
            $notice['color'] = session('color');
             return view('user.showuser', compact('user', 'notice'));
        } else {
             return view('user.showuser', compact('user'));
        }
    }

    public function adduser(Request $request) {
        $this->validate($request, [
            'username' => 'required|max:255|unique:users',
            'firstname' => 'nullable|max:255',
            'lastname' => 'nullable|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
            'mobile' => 'nullable|digits:11',
            'affiliation' => 'nullable|max:255',
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
        $user->password = Hash::make($request->password);
        $user->mobile = $request->mobile;
        $user->affiliation = $request->affiliation;
        $user->users_role = $request->users_role;

        $user->save();

        $request->session()->flash('message', 'Successfully added user!');
        $request->session()->flash('color', 'green');
        return redirect('user');
    }

    public function edituser(User $user) {
        return view('user.edituser', compact('user'));
    }

    public function updateuser(Request $request, User $user) {
        
        // return [$request->old_password, $request->password, $request->password_confirmation];
        if (Auth::user()->users_role != "admin" && Auth::user()->users_role != "media") {
                $validator = Validator::make($request->all(), [
                'username' => [
                    'required',
                    'max:255',
                    Rule::unique('users')->ignore($user->id),
                ],
                'firstname' => 'nullable|max:255',
                'lastname' => 'nullable|max:255',
                'email' => [
                    'nullable',
                    'email',
                    Rule::unique('users')->ignore($user->id),
                ],
                'old_password' => 'required',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required',
                'mobile' => 'nullable|digits:11',
                'affiliation' => 'nullable|max:255',
                'users_role' => [
                    'required',
                    Rule::in(['admin', 'media', 'treasury', 'user']),
                ],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }


            if (!Hash::check($request->old_password, $user->password)) {
                // return [$user, 'error' => 'Current password is incorrect!'];
                return view('user.edituser', ['user' => $user, 'error' => 'Current password is incorrect!']); 
            }
        } else {
            $validator = Validator::make($request->all(), [
            'username' => [
                'required',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'firstname' => 'nullable|max:255',
            'lastname' => 'nullable|max:255',
            'email' => [
                'nullable',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
            'mobile' => 'nullable|digits:11',
            'affiliation' => 'nullable|max:255',
            'users_role' => [
                'required',
                Rule::in(['admin', 'media', 'treasury', 'user']),
            ],
        ]);

        if ($validator->fails()) {
            return redirect('user/' . $user->id . '/edituser')
                        ->withErrors($validator)
                        ->withInput();
        }

        }
        $user->username = $request->username;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->mobile = $request->mobile;
        $user->affiliation = $request->affiliation;
        $user->users_role = $request->users_role;

        $user->save();

        if (Auth::user()->users_role == 'user') {
            $request->session()->flash('message', 'Successfully updated user!');
            $request->session()->flash('color', 'green');
            $url = 'user/profile';
            return redirect($url);
        } else {
            $url = 'user/' . $user->id;
            $request->session()->flash('message', 'Successfully updated credentials!');
            $request->session()->flash('color', 'green');
            return redirect($url);
        }
    }

    public function deleteuser(Request $request) {
        
        #$user = User::withCount('reservation')->withCount('log')->where('id', $request->id)->first();
        #if (Auth::user()->id == $request->id) {
        #    $users = User::all();
        #    $notice['message'] = 'Cannot delete the account you are using.';
        #    $notice['color'] = 'red';
        #    // return $this->notice;
        #} elseif ($user->reservation_count != 0 || $user->log_count) {
        #    $users = User::all();
            
        #    $notice['message'] = 'Cannot delete! User is referenced in entries in the database.';
        #    $notice['color'] = 'red';
        
        #} else {
        #    $user->users_role = 'trash';
            
        #    $users = User::all();
        #    $notice['message'] = 'Successfully deleted user!';
        #    $notice['color'] = 'green';
        #}

        $user = User::where('id', $request->id)->first();
        $reserves = Reservation::where('user_id', $user->id)
            ->where('reservations_status', 'paid')
            ->orWhere(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                ->where('reservations_status', 'not paid');                           
            });
        if ($reserves->first()) {
            $request->session()->flash('message', 'Cannot delete user with dependent entries in the database!');
            $request->session()->flash('color', 'red');
        }
        else {
            $user->users_role = 'trash';
            
            $user->save();

            $request->session()->flash('message', 'Successfully deleted user!');
            $request->session()->flash('color', 'green');
        }

        return redirect('user');
    }

    public function viewhistory(Request $request) {
        $user = Auth::user();

        $reserves = Reservation::where('user_id', $user->id)->where('reservations_status', 'paid')->orwhere('reservations_status', 'not paid')->orwhere('reservations_status', 'cancelled')->orwhere('reservations_status', 'done')->orderby('date_reserved', 'desc')->get();
        
        return view('user.history', compact('reserves'));
    }

    public function userhistory(User $user) {
        $reserves = Reservation::where('user_id', $user->id)->where('reservations_status', 'paid')->orwhere('reservations_status', 'not paid')->orwhere('reservations_status', 'cancelled')->orwhere('reservations_status', 'done')->orderby('date_reserved', 'desc')->get();

        return view('user.userhistory', compact('reserves','user'));
    }
}
