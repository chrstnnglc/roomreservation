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

Route::get('/', 'PagesController@yes');
Route::get('login', 'PagesController@login');
Route::get('register', 'PagesController@register');
Route::get('home', 'PagesController@yes');
Route::get('reserve_form', 'PagesController@reserve_form');
Route::get('reserve', 'PagesController@reserve');
Route::get('user', 'PagesController@user');
Route::get('edit_user', 'PagesController@edit_user');

// Get routes for AdminController
Route::group(['middleware' => 'admin'], function () {
	Route::get('admin/rooms', 'AdminController@rooms');
	// Route::get('admin/addroom', 'AdminController@addform');
	Route::get('admin/rooms/{room}', 'AdminController@showroom');
	Route::post('admin/rooms', 'AdminController@addroom');
	Route::get('admin/rooms/{room}/editroom', 'AdminController@editroom');
	Route::post('admin/rooms/{room}','AdminController@deleteroom');
	Route::put('admin/rooms/{room}','AdminController@updateroom');

	Route::get('admin/reservations', 'AdminController@reservations');
	Route::get('admin/reserve_form', 'AdminController@reserve_form');

	Route::get('admin/equipments', 'AdminController@equipment');
	Route::post('admin/equipments', 'AdminController@addequipment');
	Route::get('admin/equipments/{equipment}', 'AdminController@showequipment');
	Route::get('admin/equipments/{equipment}/editequipment', 'AdminController@editequipment');
	Route::put('admin/equipments/{equipment}','AdminController@updateequipment');
	Route::post('admin/equipments/{equipment}','AdminController@deleteequipment');

	Route::get('admin/user', 'AdminController@user');
	Route::post('admin/user', 'AdminController@adduser');
	Route::get('admin/user/{user}', 'AdminController@showuser');
	Route::get('admin/user/{user}/edituser', 'AdminController@edituser');
	Route::put('admin/user/{user}','AdminController@updateuser');
	Route::post('admin/user/{user}','AdminController@deleteuser');
	
	Route::get('admin/logs', 'AdminController@logs');
	Route::get('admin/payments', 'AdminController@payment');
});

#Route::group(['middleware' => 'media'], function () {
Route::get('media/rooms', 'MediaController@rooms');
Route::get('media/rooms/{room}', 'MediaController@showroom');
Route::post('media/rooms', 'MediaController@addroom');
Route::get('media/rooms/{room}/editroom', 'MediaController@editroom');
Route::post('media/rooms/{room}','MediaController@deleteroom');
Route::put('media/rooms/{room}','MediaController@updateroom');

Route::get('media/reservations', 'MediaController@reservations');
Route::get('media/reserve_form', 'MediaController@reserve_form');

Route::get('media/equipments', 'MediaController@equipment');
Route::post('media/equipments', 'MediaController@addequipment');
Route::get('media/equipments/{equipment}', 'MediaController@showequipment');
Route::get('media/equipments/{equipment}/editequipment', 'MediaController@editequipment');
Route::put('media/equipments/{equipment}','MediaController@updateequipment');
Route::post('media/equipments/{equipment}','MediaController@deleteequipment');

Route::get('media/user', 'MediaController@user');
Route::post('media/user', 'MediaController@adduser');
Route::get('media/user/{user}', 'MediaController@showuser');
Route::get('media/user/{user}/edituser', 'MediaController@edituser');
Route::put('media/user/{user}','MediaController@updateuser');
Route::post('media/user/{user}','MediaController@deleteuser');

Route::get('media/logs', 'MediaController@logs');
#});

/*

Route::get('store', 'PokemonsController@index');
Route::get('store/{pokemon}', 'PokemonsController@show');
Route::get('store/order', 'PokemonsController@order');
Route::get('add', 'PokemonsController@addform');
Route::get('store/{pokemon}/edit', 'PokemonsController@editform');
Route::post('store', 'PokemonsController@addpokemon');
Route::put('store/{pokemon}','PokemonsController@editpokemon');

*/

// Route::get('child', function(){
//     return view('child');
// });
// Route::get('test', function(){
//     return view('test');
// });