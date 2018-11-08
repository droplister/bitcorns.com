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
Route::resource('/cards', 'Api\CardsController')->only(['index', 'show']);
Route::resource('/coops', 'Api\CoopsController')->only(['index', 'show']);
Route::get('/info', 'Api\InfoController@index')->name('api.info');
Route::resource('/farms', 'Api\FarmsController')->only(['index', 'show']);
Route::post('/farms/{farm}/map', 'Api\FarmMapMarkerController@update')->name('api.farm.map');
Route::get('/map', 'Api\MapController@index')->name('api.map.index');
Route::get('/map/{coop}', 'Api\MapController@show')->name('api.map.show');
Route::get('/supply', 'Api\SupplyController@index')->name('api.supply');
Route::resource('/tokens', 'Api\TokensController')->only(['index']);
Route::get('/tokens/{token}.json', 'Api\TokensController@show')->name('api.tokens.show');
Route::get(config('bitcorn.queue_route'), 'Api\QueueController@index')->name('api.queue');
Route::get('/approval/' . config('bitcorn.approval_route') . '/{card}', 'Api\ApprovalController@update')->name('api.approval');