<?php

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

Route::get('/calculator', 'Api\CalculatorController@index')->name('api.calculator');
Route::get('/map', 'Api\MapController@index')->name('api.map.index');
Route::get('/map/{coop}', 'Api\MapController@show')->name('api.map.show');
Route::get('/farm/{farm}/map', 'Api\FarmMapMarkerController@update')->name('api.farm.map');
