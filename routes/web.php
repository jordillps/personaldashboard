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

Route::get('/', function () { return view('welcome');})->name('welcome');

//Information about
// /vendor/laravel/ui/src/AuthRouteMethods.php
Auth::routes(['verify' => true]);

Route::get('locale/{locale}', 'LocalizationController@setLocale')->name('setLocale');

//Menu
Route::get('/menu', 'MenuController@index')->name('menu');
Route::post('/order', 'OrderController@store')->name('order.store');

//Reservations
Route::get('/reservationform', 'ReservationController@reservationForm')->name('reservationform');

Route::put('confirmed/{reservation}', 'ReservationController@update')->name('reservation.update');
Route::post('reservation', 'ReservationController@store')->name('reservation.store');



//Admin
Route::group(['middleware' => ['auth']], function () {

    Route::get('/emailverification', 'HomeController@emailverification')->name('emailverification');

	Route::group(["prefix" => "home"], function() {
        Route::get('/', 'HomeController@index')->name('home');

        Route::group(["prefix" => "tables"], function() {
            Route::get('/', 'TablesController@index')->name('home.tables');
            Route::get('/export', 'TablesController@export')->name('home.tables.export');
            Route::delete('/{id}', 'TablesController@destroy')->name('home.tables.destroy');
        });

        Route::group(["prefix" => "customers"], function() {
            Route::get('/', 'CustomersController@index')->name('home.customers');
            Route::get('/export', 'CustomersController@export')->name('home.customers.export');
            Route::delete('/{id}', 'CustomersController@destroy')->name('home.customers.destroy');
        });

        Route::group(["prefix" => "reservations"], function() {
            Route::get('/', 'ReservationController@index')->name('home.reservations');
            Route::get('/export', 'ReservationController@export')->name('home.reservations.export');
            Route::delete('/{id}', 'ReservationController@destroy')->name('home.reservations.destroy');
            Route::get('/calendar', 'ReservationCalendarController@index')->name('home.reservations.calendar');
            Route::post('/calendar/create', 'ReservationCalendarController@store')->name('home.reservations.calendar.store');
            Route::post('/calendar/update', 'ReservationCalendarController@update')->name('home.reservations.calendar.update');
            Route::post('/calendar/delete', 'ReservationCalendarController@destroy')->name('home.reservations.calendar.destroy');
        });

        //Route::get('/charts', 'ChartsController@index')->name('home.charts');

        Route::get('/profile', 'ProfileController@index')->name('home.profile.index');
        Route::put('/profile', 'ProfileController@update')->name('home.profile.update');

        Route::group(["prefix" => "calendar"], function() {
            Route::get('/','CalendarController@index')->name('home.calendar');
            Route::post('/create','CalendarController@store')->name('home.calendar.store');
            Route::post('/update','CalendarController@update')->name('home.calendar.update');
            Route::post('/delete','CalendarController@destroy')->name('home.calendar.destroy');
        });

        Route::get('/importView', 'ImportController@index')->name('home.importView');
        Route::post('/import', 'ImportController@import')->name('home.import');

        Route::get('/import/{partner}', 'ImportController@printpdf')->name('home.import.printpdf');

        Route::group(["prefix" => "restaurant"], function() {
            Route::get('/','RestaurantController@index')->name('home.restaurant-tables');
            Route::get('/{table}/edit-order','OrderController@edit')->name('home.restaurant.order.edit');
            Route::put('/table/{order}/update','OrderController@update')->name('home.restaurant.order.update');
            Route::put('/table/{order}/addproducts','LineOrderController@store')->name('home.restaurant.order.addproducts');

        });

    });
});

