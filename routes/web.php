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
Route::get('/services/{id}/edit', 'ServiceController@editWeb');
Route::get('/services/{id}', 'ServiceController@viewWeb');
Route::put('/services/{id}', 'ServiceController@updateWeb');

Route::get('/packages', 'PackageController@index2');
Route::get('/packages/{id}/edit', 'PackageController@edit');
Route::put('/packages/{id}', 'PackageController@updateWeb');
