<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('yes');
});

Route::get('login', function(){
    return view('login');
});

Route::get('register', function(){
    return view('register');
});

Route::get('reservations', function(){
    return view('reservations');
});

Route::get('test', function(){
    return view('test');
});

Route::get('equipment', function(){
    return view('admin_equipment');
});

Route::get('user', function(){
    return view('admin_user');
});

Route::get('room', function(){
    return view('admin_room');
});

Route::get('reserve', function(){
    return view('admin_reserve');
});

Route::get('child', function(){
    return view('child');
});