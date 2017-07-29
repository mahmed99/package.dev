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

    return view('testing');

})->name('upload');

Route::get('/show-upload', function() {	
	return view('testing');
});


Route::get('make/pdf', function() {	
	$pdf = PDF::loadView('invoice.pdf'); //  pdf.blade.php
	return $pdf->download('invoice.pdf');  // generate invoice.pdf
	//return $pdf->stream('invoice.pdf');
});

Route::get('/view/pdf', function() {    
	return view('invoice.pdf');
});

Route::get('/view/bng', function() {    
	$data = [
		'foo' => 'লারাভেল',
	];
	return view('invoice.bngpdf', ['data' => $data]);
});

Route::get('make/bngpdf', function() {	
	$data = [
		'foo' => 'লারাভেল',
	];	
	$pdf = PDF::loadView('invoice.bngpdf', ['data' => $data]);	
	return $pdf->stream('laravel.pdf');  // generate invoice.pdf
	// //return $pdf->stream('invoice.pdf');
	
});


// Route::get('test', function() {
// 	Storage::disk('local')->put('public/hello.txt', 'hello world'); //app/storage/public/hello.txt 
// 	echo 'file created';
	
// 	$exists = Storage::disk('public')->exists('hello.txt');
// 	//dd($exists);
// 	//return $exists;
// 	echo asset('storage/hello.txt');
// 	$contents = Storage::disk('public')->get('hello.txt'); //public/storage/hello.txt
	
// 	return $contents;
// });

