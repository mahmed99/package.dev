<?php

namespace Mahmed99\Sslcommerzpayment\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Order; //app()->getNamespace();
use App\User;
use Mahmed99\Sslcommerzpayment\Repositories\PaymentRepository;

class PaymentController extends Controller
{
	protected $payment;
    
	public function __construct(PaymentRepository $payment)
    {
       $this->payment = $payment;	   
    }
    
    public function payNow($order, Request $request)
    {
         $a= app()->getNamespace()."Order";
         $Order = new $a;
    	 //$Order = new \App\Order;
          $order = $Order->find($order);  
        //dd($order);
        $orderId = $order->id;                
        $amount = $order->amount;        
        
        $onlineCharge = number_format(($this->payment->getOnlineCharge()*$amount), 2, '.', '');
        $totalAmount = $amount + $onlineCharge;
        

        //$user = $request->user();          
        //$name = $user->name;
        //$email = $user->email;
        $user = User::find(1); 
        //dd($user);

        if ($user !== null) {

            $order = [
                'order_id' => $orderId,                        
                'total_amount' => $totalAmount
            ];
            
            $this->payment->setSessionForOrderedInfo($order, $request);         
            
            $sandbox = config('sslcommerzpayment.sslcommerz.sandbox');
            $gwUrl = ($sandbox) ? config('sslcommerzpayment.sslcommerz.sandbox_url') : config('sslcommerzpayment.sslcommerz.live_url');   

            $storeId = config('sslcommerzpayment.sslcommerz.store_id');          

            return view('sslcommerzpayment::payment', compact(
                            'gwUrl', 
                            'orderId', 
                            'amount',
                            'onlineCharge',
                            'totalAmount', 
                            'user',
                            'storeId'
                    ));
        }
        $errorMsg = 'Guest is not allowed to do this. Login or Signup Please!';
        return view ('sslcommerzpayment::error', compact('errorMsg'));        
        
    }

}