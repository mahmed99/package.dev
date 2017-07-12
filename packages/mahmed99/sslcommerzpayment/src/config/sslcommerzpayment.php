<?php 

return [
	'sslcommerz' => [        
		'sandbox' => true,
		'online_charge' => 3.5,
		'store_id' => env('SSLCOMMERZ_STORE_ID'),
	    'store_password' => env('SSLCOMMERZ_STORE_PASSWORD'),
	    'sandbox_url' => 'https://sandbox.sslcommerz.com/gwprocess/v3/process.php',       
	    'live_url' => 'https://securepay.sslcommerz.com/gwprocess/v3/process.php',
	    'sandbox_validation_url' => 'https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php',   
	    'live_validation_url' => 'https://securepay.sslcommerz.com/validator/api/validationserverAPI.php'               
    ],
];