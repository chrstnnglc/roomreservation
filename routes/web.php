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
// Get routes for PagesController
Auth::routes();

Route::get('/', 'PagesController@index'); // dapat index pero sige ito muna
// Route::get('login', 'PagesController@login');
// Route::get('success', 'PagesController@success');
// Route::get('register', 'PagesController@register');
// Route::get('home', 'PagesController@yes');

Route::get('reserve_form', 'PagesController@reserve_form');
Route::get('reserve', 'PagesController@reserve');
Route::get('user', 'PagesController@user');
Route::get('edit_user', 'PagesController@edit_user');

// Get routes for AdminController

Route::get('rooms', 'RoomsController@index');
Route::get('rooms/{room}', 'RoomsController@showroom');
Route::post('rooms', 'RoomsController@addroom');
Route::get('rooms/{room}/editroom', 'RoomsController@editroom');
Route::post('rooms/{room}','RoomsController@deleteroom');
Route::put('rooms/{room}','RoomsController@updateroom');
Route::get('rooms/rooms_form', 'RoomsController@room_form');

Route::get('equipment', 'EquipmentsController@index');
Route::post('equipment', 'EquipmentsController@addequipment');
Route::get('equipments/{equipment}', 'EquipmentsController@showequipment');
Route::get('equipments/{equipment}/editequipment', 'EquipmentsController@editequipment');
Route::put('equipments/{equipment}','EquipmentsController@updateequipment');
Route::post('equipments/{equipment}','EquipmentsController@deleteequipment');
Route::get('equipments/equipment_form', 'EquipmentsController@equipment_form');

Route::get('reservations', 'ReservationsController@index');
Route::post('reservations', 'ReservationsController@addreservation');
Route::get('reserve_form', 'ReservationsController@reserve_form');

Route::get('user', 'UserController@userslist');
Route::post('user', 'UserController@adduser');
Route::get('user/{user}', 'UserController@showuser');
Route::get('user/{user}/edituser', 'UserController@edituser');
Route::put('user/{user}','UserController@updateuser');
Route::post('user/{user}','UserController@deleteuser');

// #Route::group(['middleware' => 'media'], function () {
// Route::get('media/rooms', 'MediaController@rooms');
// Route::get('media/rooms/{room}', 'MediaController@showroom');
// Route::post('media/rooms', 'MediaController@addroom');
// Route::get('media/rooms/{room}/editroom', 'MediaController@editroom');
// Route::post('media/rooms/{room}','MediaController@deleteroom');
// Route::put('media/rooms/{room}','MediaController@updateroom');

// Route::get('media/reservations', 'MediaController@reservations');
// Route::get('media/reserve_form', 'MediaController@reserve_form');

// Route::get('media/equipments', 'MediaController@equipment');
// Route::post('media/equipments', 'MediaController@addequipment');
// Route::get('media/equipments/{equipment}', 'MediaController@showequipment');
// Route::get('media/equipments/{equipment}/editequipment', 'MediaController@editequipment');
// Route::put('media/equipments/{equipment}','MediaController@updateequipment');
// Route::post('media/equipments/{equipment}','MediaController@deleteequipment');

// Route::get('media/user', 'MediaController@user');
// Route::post('media/user', 'MediaController@adduser');
// Route::get('media/user/{user}', 'MediaController@showuser');
// Route::get('media/user/{user}/edituser', 'MediaController@edituser');
// Route::put('media/user/{user}','MediaController@updateuser');
// Route::post('media/user/{user}','MediaController@deleteuser');

// Route::get('media/logs', 'MediaController@logs');
// #});


Route::get('treasury/reservations', 'TreasuryController@reservations');
Route::patch('treasury/reservation/{reserve}', 'TreasuryController@updatereservation');