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
Route::get('/', 'PagesController@yes');
Route::get('login', 'PagesController@login');
Route::get('register', 'PagesController@register');

// Get routes for AdminController
Route::get('admin/reservations', 'AdminController@reservations');
Route::get('admin/equipment', 'AdminController@equipment');
Route::get('admin/user', 'AdminController@user');
Route::get('admin/room', 'AdminController@room');
Route::get('admin/reserve', 'AdminController@reserve');

// Route::get('child', function(){
//     return view('child');
// });
// Route::get('test', function(){
//     return view('test');
// });