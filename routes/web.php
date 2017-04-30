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
Auth::routes();

Route::get('/', 'PagesController@index');

Route::get('reserve_form', 'PagesController@reserve_form');
Route::get('reserve', 'PagesController@reserve');
Route::get('user', 'PagesController@user');
Route::get('edit_user', 'PagesController@edit_user');

Route::get('rooms', 'RoomsController@index');
Route::get('rooms/form', 'RoomsController@form');
Route::get('rooms/{room}', 'RoomsController@showroom');
Route::post('rooms', 'RoomsController@addroom');
Route::get('rooms/{room}/editroom', 'RoomsController@editroom');
Route::post('rooms/{room}','RoomsController@deleteroom');
Route::put('rooms/{room}','RoomsController@updateroom');

Route::get('equipment', 'EquipmentsController@index');
Route::get('equipment/form', 'EquipmentsController@form');
Route::post('equipment', 'EquipmentsController@addequipment');
Route::get('equipment/{equipment}', 'EquipmentsController@showequipment');
Route::get('equipment/{equipment}/editequipment', 'EquipmentsController@editequipment');
Route::put('equipment/{equipment}','EquipmentsController@updateequipment');
Route::post('equipment/{equipment}','EquipmentsController@deleteequipment');

Route::get('reservations', 'ReservationsController@index');
Route::post('reservations', 'ReservationsController@addreservation');
Route::get('reservations/form', 'ReservationsController@form');
Route::patch('reservations/{reserve}', 'ReservationsController@updatereservation');
Route::post('reservations/{reserve}','ReservationsController@deletereservation');

Route::get('user', 'UserController@userslist');
Route::get('user/form', 'UserController@user_form');
Route::post('user', 'UserController@adduser');
Route::get('user/profile', 'UserController@profile');
Route::get('user/{user}', 'UserController@showuser');
Route::get('user/{user}/edituser', 'UserController@edituser');
Route::put('user/{user}','UserController@updateuser');
Route::post('user/{user}','UserController@deleteuser');
Route::get('user/profile/past','UserController@viewhistory');

Route::get('logs', 'LogsController@index');