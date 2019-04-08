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


// Route::get('/', 'UserController@index');

/*Route::get('/', 'UserController@signup');

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
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');



Route::get('/user/manage-users','UserController@manageUser')->name('userList');
Route::get('/user/{user_id}/permission','UserController@assignPermissionToUser')->name('userPermission');
Route::get('/user/{user_id}/role','UserController@assignRoleToUser')->name('userRole');
Route::post('/user/{user_id}/permission','UserController@validateAssignPermissionToUser');
Route::post('/user/{user_id}/role','UserController@validateAssignPermissionToUser');


Route::get('/roles/show','UserController@roleShow')->name('roleList');
Route::get('/roles/create','UserController@roleCreate')->name('roleCreate');
Route::get('/roles/{role_id}/edit','UserController@roleEdit')->name('roleEdit');
Route::get('/roles/destroy','UserController@roleDestroy')->name('roleDestroy');
Route::post('/roles/create','UserController@validateCreateRole');
Route::post('/roles/{role_id}/edit','UserController@roleUpdate');


Route::get('/permissions/show','UserController@permissionShow')->name('permissionList');
Route::get('/permissions/create','UserController@permissionCreate')->name('permissionCreate');
Route::get('/permissions/{permission_id}/edit','UserController@permissionEdit')->name('permissionEdit');
Route::get('/permissions/{permission_id}/destroy','UserController@permissionDestroy')->name('permissionDestroy');
Route::post('/permissions/create','UserController@validatePermission');
Route::post('/permissions/{permission_id}/edit','UserController@validatePermission'); 


Route::get('/post','PostController@index')->name('postList');
Route::get('/post/{update_id}/edit','PostController@edit')->name('postEdit');
Route::get('/post/create','PostController@create')->name('postCreate');
Route::post('/post/{update_id}/edit','PostController@validatePost');
Route::post('/post/create','PostController@validatePost');


Route::get('/getDetails', 'GetComponentDetailController@getData');
Route::get('/getPosts', 'GetComponentDetailController@getPost');
Route::get('/getPostById/{id}', 'GetComponentDetailController@getPostById');
Route::post('/createPost', 'GetComponentDetailController@createPost');


/*
	Route::group(['middleware' => ['auth']], function () {
	Route::resource('role', 'RoleController');
	Route::resource('users', 'UserController');
	Route::resource('products', 'ProductController');
});*/