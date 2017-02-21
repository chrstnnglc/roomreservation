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
Route::get('profile', 'UserController@index');

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

	Route::get('admin/equipments', 'AdminController@equipment');
	Route::post('admin/equipments', 'AdminController@addequipment');
	Route::get('admin/equipments/{equipment}', 'AdminController@showequipment');
	Route::get('admin/equipments/{equipment}/editequipment', 'AdminController@editequipment');
	Route::put('admin/equipments/{equipment}','AdminController@updateequipment');
	Route::post('admin/equipments/{equipment}','AdminController@deleteequipment');

	Route::get('admin/user', 'AdminController@user');
	
	Route::get('admin/reserve', 'AdminController@reserve');
});

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