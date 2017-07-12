<?php 

//Route::get('/test', 'Naoray\Test\Http\Controllers\TestController@index');


Route::get('/pay/{booking}', 'Mahmed99\Sslcommerzpayment\Controllers\PaymentController@payNow');

Route::post('/sslcommerz/payment/success', 'Mahmed99\Sslcommerzpayment\Controllers\PaymentSuccessController@payment');
Route::post('/sslcommerz/payment/fail', 'Mahmed99\Sslcommerzpayment\Controllers\PaymentFailedController@payment');
Route::post('/sslcommerz/payment/cancel', 'Mahmed99\Sslcommerzpayment\Controllers\PaymentCancelledController@payment');