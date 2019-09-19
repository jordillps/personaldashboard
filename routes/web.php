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

Auth::routes();

Route::get('locale/{locale}', 'LocalizationController@setLocale')->name('setLocale');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/tables', 'TablesController@index')->name('home.tables');
Route::get('/home/charts', 'ChartsController@index')->name('home.charts');


