<?php

namespace Mahmed99\Sslcommerzpayment\Repositories;

use Illuminate\Http\Request;

//use App\User;
use App\Order;


class PaymentRepository
{
	
	protected $onlineCharge;

	public function __construct()
    {
       $this->setOnlineCharge();
    }
   

    public function setSessionForOrderedInfo(array $order, Request $request)
    {
        foreach ($order as $key => $value) {
        	$request->session()->put($key, $value);
        }
        return;
    }

    public function getSessionForOrderedInfo()
    {
    	return [
        	'orderId' => session('order_id'),	        	        
	        'totalAmount' => session('total_amount')
        ];
    }
    
    public function setOnlineCharge()
    {
    	//find $value from database settings table
        $value = config('sslcommerzpayment.sslcommerz.online_charge');
    	$this->onlineCharge = $value/100;
    	return;
    }

    public function getOnlineCharge()
    {
    	return ($this->onlineCharge/100);
    }
    
}