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
})->name('welcome');

Auth::routes(['verify' => true]);

Route::get('locale/{locale}', 'LocalizationController@setLocale')->name('setLocale');

Route::group(['middleware' => ['auth']], function () {
	Route::group(["prefix" => "home"], function() {
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/tables', 'TablesController@index')->name('home.tables');
        Route::get('/charts', 'ChartsController@index')->name('home.charts');

        Route::get('/profile', 'ProfileController@index')->name('home.profile');

    });
});

