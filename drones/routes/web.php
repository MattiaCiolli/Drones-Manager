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
    return view('newOrder');
});

Route::get('/newOrder', 'TransportOrderController@newOrder');

#Route::get('/insertAddress', 'TransportOrderController@insertAddress');

Route::get('/insertProducts', 'TransportOrderController@productAnalysis');


Route::get('/insertAddress', function () {
    return view('insertAddress');
});