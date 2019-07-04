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
Route::get('best-score', 'UserController@best');

Route::group([
  	'middleware' => 'auth:api'
], function() {
	Route::apiResource('users', 'UserController');
	Route::apiResource('questions', 'QuestionController');
    Route::get('user', 'AuthController@user');
    Route::post('logout', 'AuthController@logout');
});
