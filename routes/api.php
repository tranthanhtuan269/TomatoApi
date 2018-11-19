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

Route::get('users', 'UserController@index');
Route::get('users/orders', 'UserController@orders');
Route::get('users/neworders', 'UserController@newOrders');
Route::get('users/oldorders', 'UserController@oldOrders');
Route::get('users/{id}', 'UserController@show');

Route::get('services', 'ServiceController@index');
Route::get('services/{id}', 'ServiceController@show');
Route::get('services/{id}/subservice', 'ServiceController@subservice');

Route::get('packages', 'PackageController@index');
Route::get('packages/{id}', 'PackageController@show');

Route::get('orders', 'OrderController@index');
Route::get('orders/{id}', 'OrderController@show');

Route::get('news', 'NewsController@index');
Route::get('news/{id}', 'NewsController@show');

Route::get('groups', 'GroupController@index');
Route::get('groups/{id}', 'GroupController@show');
Route::get('groups/{id}/users', 'GroupController@users');
    
Route::post('users', 'UserController@store');
Route::post('users/{id}', 'UserController@update');
Route::post('users/{id}/info', 'UserController@updateIOS');
Route::delete('users/{id}', 'UserController@destroy');

Route::post('orders', 'OrderController@store');
Route::post('orders/{id}/update', 'OrderController@update');
Route::post('orders/{id}/addImage', 'OrderController@uploadImage');
Route::post('orders/{id}/pushImage', 'OrderController@uploadImageIOS');
Route::put('orders/{id}', 'OrderController@update');
Route::post('orders/{id}', 'OrderController@destroy');
Route::delete('orders/{id}', 'OrderController@destroy');

Route::post('groups', 'GroupController@store');
Route::put('groups/{id}', 'GroupController@update');
Route::delete('groups/{id}', 'GroupController@destroy');
Route::post('groups/{id}', 'GroupController@destroy');

Route::post('packages', 'PackageController@store');
Route::put('packages/{id}', 'PackageController@update');
Route::delete('packages/{id}', 'PackageController@destroy');

Route::post('news', 'NewsController@store');
Route::put('news/{id}', 'NewsController@update');
Route::delete('news/{id}', 'NewsController@destroy');

Route::post('admin/accept', 'AdminController@accept');
Route::post('admin/reject', 'AdminController@reject');

Route::post('logout', 'AuthController@logout');

Route::get('why-use', 'HomeController@whyUse');
Route::get('best-practices', 'HomeController@bestPractices');
Route::get('faqs', 'HomeController@faqs');
Route::get('coupon', 'HomeController@coupon');
Route::get('report-and-feedback', 'HomeController@reportAndFeedback');
Route::get('contact', 'HomeController@contact');
Route::get('legal', 'HomeController@legal');
Route::get('about', 'HomeController@about');
Route::get('favorite-tasker', 'HomeController@favoriteTasker');
Route::get('hspinfo', 'HomeController@hspinfo');

Route::get('get-content', 'HomeController@getContent');
Route::post('uploadImage', 'HomeController@uploadImageApi');
Route::post('feedbacks', 'HomeController@feedbacks');