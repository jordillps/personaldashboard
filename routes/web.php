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
        Route::get('/tables/export/', 'TablesController@export')->name('home.tables.export');
        Route::delete('/tables/{id}', 'TablesController@destroy')->name('home.tables.destroy');
        Route::get('/charts', 'ChartsController@index')->name('home.charts');

        Route::get('/profile', 'ProfileController@index')->name('home.profile.index');
        Route::put('/profile', 'ProfileController@update')->name('home.profile.update');

        Route::group(["prefix" => "calendar"], function() {
            Route::get('/','CalendarController@index')->name('home.calendar');
            Route::post('/create','CalendarController@store')->name('home.calendar.store');
            Route::post('/update','CalendarController@update')->name('home.calendar.update');
            Route::post('/delete','CalendarController@destroy')->name('home.calendar.destroy');
        });

    });
});

