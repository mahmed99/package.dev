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
});

Route::get('/paymentdata/{order}', function($order) {
	$data = Sslcommerz::paymentData($order);
	return ($data->count() > 0) ? $data : 'Found Nothing';
});

Route::get('/validationdata/{order}', function($order) {
	$data = Sslcommerz::validationData($order);
	return ($data->count() > 0) ? $data : 'Found Nothing';
});

// Route::get('/paymentdata/{order}', 'PaymentInfoController@paymentData');
// Route::get('/validationdata/{order}', 'PaymentInfoController@validationData');