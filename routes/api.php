<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'AuthController@login');
Route::post('signup', 'AuthController@signup');

Route::group([
  'middleware' => 'auth:api'
], function() {
	
	Route::apiResource('users', 'UserController');
    Route::get('users/{id}/orders', 'UserController@orders');

    Route::apiResource('orders', 'OrderController');
    Route::apiResource('groups', 'GroupController');
    Route::apiResource('packages', 'PackageController');
	Route::apiResource('services', 'ServiceController');
    Route::get('groups/{id}/users', 'GroupController@users');
	
    Route::post('admin/accept', 'AdminController@accept');
    Route::post('admin/reject', 'AdminController@reject');

    Route::post('logout', 'AuthController@logout');
});
