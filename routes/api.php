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

Route::get('users', 'ApiController@userIndex');
Route::get('users/orders', 'ApiController@userOrders');
Route::get('users/neworders', 'ApiController@userNewOrders');
Route::get('users/oldorders', 'ApiController@userOldOrders');
Route::get('users/{id}', 'ApiController@userShow');
Route::post('users/{id}', 'ApiController@userUpdate');
Route::post('users/{id}/info', 'ApiController@userUpdateIOS');

Route::get('cities', 'ApiController@getCities');
Route::get('cities/{id}', 'ApiController@getCity');


Route::get('services', 'ApiController@serviceIndex');
Route::get('services2', 'ApiController@serviceIndex2');
Route::get('services/{id}', 'ApiController@serviceShow');
Route::get('services/{id}/subservice', 'ApiController@subservice');

Route::post('orders', 'ApiController@orderStore');
Route::post('orders/{id}/update', 'ApiController@orderUpdate');
Route::post('orders/{id}/addImage', 'ApiController@orderUploadImage');
Route::post('orders/{id}/pushImage', 'ApiController@orderUploadImageIOS');
Route::put('orders/{id}', 'ApiController@orderUpdate');
Route::post('orders/{id}', 'ApiController@orderDestroy');
Route::delete('orders/{id}', 'ApiController@orderDestroy');

Route::get('coupons/checkCoupon', 'ApiController@checkCoupon');


Route::get('news', 'ApiController@newsIndex');
Route::get('news/{id}', 'ApiController@newsShow');

Route::get('why-use', 'ApiController@whyUse');
Route::get('best-practices', 'ApiController@bestPractices');
Route::get('faqs', 'ApiController@faqs');
Route::get('coupon', 'ApiController@coupon');
Route::get('report-and-feedback', 'ApiController@reportAndFeedback');
Route::get('contact', 'ApiController@contact');
Route::get('legal', 'ApiController@legal');
Route::get('about', 'ApiController@about');
Route::get('favorite-tasker', 'ApiController@favoriteTasker');
Route::get('hspinfo', 'ApiController@hspinfo');

Route::get('get-content', 'ApiController@getContent');
Route::post('uploadImage', 'ApiController@uploadImageApi');
Route::post('feedbacks', 'ApiController@feedbacks');

Route::get('test', 'ApiController@test');
Route::get('wallpaper', 'ApiController@wallpaper');