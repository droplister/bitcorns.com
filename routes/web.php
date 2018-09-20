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

Route::resource('/', 'HomeController', ['only' => ['index']]);
Route::resource('/cards', 'CardsController', ['only' => ['index', 'show', 'create', 'store', 'update']]);
Route::resource('/farms', 'FarmsController');
Route::resource('/harvests', 'HarvestsController', ['only' => ['index', 'show']]);
Route::resource('/tokens', 'TokensController');
Route::get('/buy', 'PagesController@buy')->name('pages.buy');
Route::redirect('/submit', '/cards/create', 301);
Route::redirect('/almanac', '/harvests', 301);
