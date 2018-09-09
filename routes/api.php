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
    Route::get('users/{id}/jobs', 'UserController@jobs');

    Route::apiResource('jobs', 'JobController');
	Route::apiResource('groups', 'GroupController');
    Route::get('groups/{id}/users', 'GroupController@users');
    Route::get('groups/{id}/wait', 'GroupController@wait');
    Route::post('groups/{id}/join', 'GroupController@join');
    Route::post('groups/{id}/leave', 'GroupController@leave');
	
    Route::post('admin/accept', 'AdminController@accept');
    Route::post('admin/reject', 'AdminController@reject');

    Route::post('logout', 'AuthController@logout');
});
