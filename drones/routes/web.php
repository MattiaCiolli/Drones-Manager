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

Route::get('/insertAddress', 'TransportOrderController@insertAddress');

Route::get('/productAnalysis', 'TransportOrderController@productAnalysis');


Route::get('/insertAddress', function () {
    return view('insertAddress');
});

Route::get('/insertProducts', function () {
    return view('insertProduct');
});

Route::get('/insertAddress/{destinationAddress}', 'TransportOrderController@insertAddress');

Route::get('/calculatePrice', 'TransportOrderController@calculatePrice');