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

Route::get('services', 'ServiceController@index');
Route::get('services/{id}', 'ServiceController@show');
Route::get('services/{id}/subservice', 'ServiceController@subservice');
Route::get('packages', 'PackageController@index');
Route::get('packages/{id}', 'PackageController@show');
Route::get('orders', 'OrderController@index');
Route::get('orders/{id}', 'OrderController@show');
Route::get('groups', 'GroupController@index');
Route::get('groups/{id}', 'GroupController@show');

Route::get('why-use', 'HomeController@whyUse');
Route::get('best-practices', 'HomeController@bestPractices');
Route::get('faqs', 'HomeController@faqs');
Route::get('report-and-feedback', 'HomeController@reportAndFeedback');
Route::get('contact', 'HomeController@contact');
Route::get('legal', 'HomeController@legal');
Route::get('about', 'HomeController@about');
Route::get('favorite-tasker', 'HomeController@favoriteTasker');
