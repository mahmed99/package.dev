<?php 

Route::group(['middleware' => ['web']], function () {
	
	Route::get('/test', 'Mahmed99\Sslcommerzpayment\Controllers\TestController@index');

	Route::get('/pay/{order}', 'Mahmed99\Sslcommerzpayment\Controllers\PaymentController@payNow')->name('sslcommerz.payment');

	/*Route::post('/sslcommerz/payment/success', 'Mahmed99\Sslcommerzpayment\Controllers\PaymentSuccessController@payment')->name('success');
	Route::post('/sslcommerz/payment/fail', 'Mahmed99\Sslcommerzpayment\Controllers\PaymentFailedController@payment')->name('fail');
	Route::post('/sslcommerz/payment/cancel', 'Mahmed99\Sslcommerzpayment\Controllers\PaymentCancelledController@payment')->name('cancel');*/
});


Route::prefix('sslcommerz')->middleware(['web'])->group(function () {

	Route::post('payment/success', 'Mahmed99\Sslcommerzpayment\Controllers\PaymentSuccessController@payment')->name('sslcommerz.success');
	Route::post('payment/fail', 'Mahmed99\Sslcommerzpayment\Controllers\PaymentFailedController@payment')->name('sslcommerz.fail');
	Route::post('payment/cancel', 'Mahmed99\Sslcommerzpayment\Controllers\PaymentCancelledController@payment')->name('sslcommerz.cancel');
	
});

