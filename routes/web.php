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
use Illuminate\Http\Request;

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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/invoice', function () {
	return view('invoice.invoice');
});

Route::get('/test/{file}', function($file) {
	Storage::disk('public')->put('avatars/'.$file.'.txt', 'hello world');
	
	$exists = Storage::disk('public')->exists('hello.txt');

	$url = env('APP_URL').Storage::url('hello.txt');

	$contents = $exists ? Storage::disk('public')->get('hello.txt') : 'nothing';

	return view('testfile', [
		'contents' => $contents,
		'url' => $url,
		]);
});

Route::get('/upload', function() {	
	return view('upload');
});

Route::post('/upload', function(Request $request) {	
	
	$exists = Storage::exists('public/images/logo.png');
	if ($exists) {		
		$date = date('YmdHis');		
		$src = 'public/images/logo.png';
		$dest = sprintf('public/images/%s-logo.png', $date); 
		//$dest = sprintf('public/images/%1$s-logo-%1$s.png', $date); // placholder %1$s
		Storage::copy($src, $dest);	
	}
	
	$file = $request->file('avatar');
	$fileOriginlName = $file->getClientOriginalName();	
	$path = $file->storeAs('public/images', $fileOriginlName);

    return sprintf('Uploaded here: %s', $path);	

})->name('upload');

Route::get('make/pdf', function() {	
	$pdf = PDF::loadView('invoice.pdf'); //  pdf.blade.php
	return $pdf->download('invoice.pdf');  // generate invoice.pdf
	//return $pdf->stream('invoice.pdf');
	
	
});

Route::get('/view/pdf', function() {    
	return view('invoice.pdf');
});

