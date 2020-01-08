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
    return view('auth.login');
});

Auth::routes();
// Auth::routes(['register' => false]);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('{path}', 'HomeController@index')->where('path', '([A-z\d\/_.]+)?');
Route::get('/+receipt/{id}', 'ReceiptController@show');


Route::get('/clear', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});