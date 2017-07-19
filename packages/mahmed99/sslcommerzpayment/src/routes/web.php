<?php 

Route::group(['middleware' => ['web']], function () {
	Route::get('/test', 'Mahmed99\Sslcommerzpayment\Controllers\TestController@index');

Route::get('/pay/{order}', 'Mahmed99\Sslcommerzpayment\Controllers\PaymentController@payNow')->name('payment');

Route::post('/sslcommerz/payment/success', 'Mahmed99\Sslcommerzpayment\Controllers\PaymentSuccessController@payment')->name('success');
Route::post('/sslcommerz/payment/fail', 'Mahmed99\Sslcommerzpayment\Controllers\PaymentFailedController@payment')->name('fail');
Route::post('/sslcommerz/payment/cancel', 'Mahmed99\Sslcommerzpayment\Controllers\PaymentCancelledController@payment')->name('cancel');
});

