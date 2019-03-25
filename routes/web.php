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

/*

Route::get('/test', function() {
  echo "Test Controler";
});

Route::get('/user', function() {
  return view('user.index');
});

Route::get('/user/{id}/{name}', function($id, $name) {
  return 'This is the user '.$name. ' with the id of ' . $id;
});

*/

/*Route::get('/', function () { 
  return view('layout/app');
});*/



Route::get('/', 'UserController@signup');

Route::get('/user', 'UserController@index');

Route::get('/login', 'UserController@login');

Route::post('/login', 'UserController@validateLogin');

Route::get('/signup', 'UserController@signup');

Route::post('/signup', 'UserController@validateSignup');

Route::get('/dashboard',  'UserController@dashboard');

Route::post('/fileupload', 'UserController@fileupload');

Route::get('/delete-image/{deleteid}','UserController@deleteImage');

Route::get('/order','UserController@order');

Route::get('/create-order','UserController@createOrder');

Route::post('/create-order','UserController@validateOrderForm');

Route::get('/view-order/{order_id}','UserController@viewOrder');