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

Route::get('/newOrder', function () {
    return view('newOrder');
});

Route::get('/insertAddress', 'TransportOrderController@newOrder');

Route::post('/insertAddress', 'TransportOrderController@insertAddress');


Route::post('/insertProduct', 'TransportOrderController@productAnalysis');

/*
Route::get('/insertProduct', function () {
    return view('insertProduct');
});

*/

Route::get('/insertProduct', 'TransportOrderController@insertProduct');

Route::get('/orderSummary', 'TransportOrderController@orderSummary');


//Route::get('/p', 'TransportOrderController@productAnalysis');

Route::get('/confirm', 'SchedulerController@getTimeDelivery');

Route::get('/confirmation', 'SchedulerController@confirmOrder');
Route::get('/cancellation', 'SchedulerController@cancelOrder');


/*
Route::get('/confirmation', function () {
    return view('totalConfirm');
});
*/

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/diary', 'HomeController@getDiaries');
