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
Route::get('/', 'ReportController@daily');

Route::get('/terms', function () {
    return view('terms');
});

Route::get('/test', function () {
    // send email to setting
    $emaiSetting = \App\Setting::where('key', 'adminEmail')->first();

    $emaiSetting->value = str_replace(" ","",$emaiSetting->value);

    $emailArray = explode(",",$emaiSetting->value);
    $job = \App\Order::find(5);
    \Mail::send('emails.created_job', ['job' => $job], function($message) use ($emailArray){
        $message->from('postmaster@hspvietnam.com', 'hspvietnam.com');
        $message->to($emailArray)->subject('HSP thông báo đăng ký thành công!');
    });
});
Route::get('/privacy', function () {
    return view('privacy');
});

Route::get('/products', 'ProductController@index');
Route::get('/products/create', 'ProductController@create');
Route::post('/products', 'ProductController@store');
Route::get('/products/{id}', 'ProductController@view');
Route::get('/products/{id}/edit', 'ProductController@edit');
Route::put('/products/{id}', 'ProductController@update');
Route::delete('/products/{id}', 'ProductController@destroy');

Route::get('/categories', 'CategoryController@index');
Route::post('/categories', 'CategoryController@store');
Route::get('/categories/{id}', 'CategoryController@view');
Route::get('/categories/{id}/edit', 'CategoryController@edit');
Route::get('/categories/create', 'CategoryController@create');
Route::put('/categories/{id}', 'CategoryController@update');
Route::delete('/categories/{id}', 'CategoryController@destroy');

Route::get('/news', 'NewsController@indexWeb');
Route::post('/news', 'NewsController@storeWeb');
Route::get('/news/{id}/edit', 'NewsController@editWeb');
Route::get('/news/create', 'NewsController@createWeb');
Route::get('/news/{id}', 'NewsController@viewWeb');
Route::put('/news/{id}', 'NewsController@updateWeb');
Route::delete('/news/{id}', 'NewsController@destroyWeb');

Route::resource('/partners', 'PartnerController');

Route::get('/users', 'UserController@indexWeb');

Route::get('/orders', 'OrderController@indexWeb');
Route::get('/orders/acceptedOrder', 'OrderController@acceptedOrder');
Route::post('/orders', 'OrderController@storeWeb');
Route::get('/orders/new', 'OrderController@newOrder');
Route::get('/orders/accepted', 'OrderController@acceptedOrder');
Route::get('/orders/paid', 'OrderController@paidOrder');
Route::get('/orders/cancel', 'OrderController@cancelOrder');
Route::get('/orders/{id}', 'OrderController@viewWeb');
Route::get('/orders/{id}/edit', 'OrderController@editWeb');
Route::post('/orders/{id}/accept', 'OrderController@acceptWeb');
Route::post('/orders/{id}/paid', 'OrderController@paidWeb');
Route::post('/orders/{id}/cancel', 'OrderController@cancelWeb');
Route::get('/orders/create', 'OrderController@createWeb');
Route::put('/orders/{id}', 'OrderController@updateWeb');
Route::delete('/orders/{id}', 'OrderController@destroyWeb');

Route::get('/pages', 'HomeController@pages');
Route::put('/pages/{id}', 'HomeController@updatePage');

Route::get('/settings', 'HomeController@settings');
Route::post('/settings', 'HomeController@storeSettings');

Route::resource('coupons', 'CouponController');

Route::get('reports/daily', 'ReportController@daily');
Route::get('reports/weekly', 'ReportController@weekly');
Route::get('reports/monthly', 'ReportController@monthly');
Route::get('reports/custom', 'ReportController@custom');
Route::post('reports/export', 'ReportController@export');
Route::get('reports/user', 'ReportController@userExport');


Route::get('cooperators', 'CooperatorController@index');
Route::get('cooperators/{id}', 'CooperatorController@view');
Route::post('cooperators/pay', 'CooperatorController@pay');



Route::post('/images/uploadImage', 'HomeController@uploadImage');
Route::get('/export', 'HomeController@export');
Route::get('/logout', 'HomeController@logout')->name('logout');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test', 'HomeController@test')->name('test');
