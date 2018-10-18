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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/terms', function () {
    return view('terms');
});
Route::get('/privacy', function () {
    return view('privacy');
});

Route::get('/services', 'ServiceController@indexWeb');
Route::post('/services', 'ServiceController@storeWeb');
Route::get('/services/{id}/edit', 'ServiceController@editWeb');
Route::get('/services/create', 'ServiceController@createWeb');
Route::get('/services/{id}', 'ServiceController@viewWeb');
Route::put('/services/{id}', 'ServiceController@updateWeb');
Route::delete('/services/{id}', 'ServiceController@destroyWeb');

Route::get('/packages', 'PackageController@indexWeb');
Route::post('/packages', 'PackageController@storeWeb');
Route::get('/packages/{id}/edit', 'PackageController@editWeb');
Route::get('/packages/create', 'PackageController@createWeb');
Route::get('/packages/{id}', 'PackageController@viewWeb');
Route::put('/packages/{id}', 'PackageController@updateWeb');
Route::delete('/packages/{id}', 'PackageController@destroyWeb');

Route::get('/pages', 'HomeController@pages');
Route::put('/pages/{id}', 'HomeController@updatePage');

Route::post('/images/uploadImage', 'HomeController@uploadImage');

