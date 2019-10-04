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

Route::get('cities', 'ApiController@getCities');
Route::get('cities/{id}', 'ApiController@getCity');

Route::get('categories', 'ApiController@getCategories');
Route::get('categories/{id}', 'ApiController@getCategory');

Route::get('products/{id}', 'ApiController@getProduct');

Route::post('orders', 'ApiController@orderStore');
Route::get('coupons/{coupon}', 'ApiController@checkCoupon');

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