<?php

namespace Mahmed99\Sslcommerzpayment\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Order;
use Mahmed99\Sslcommerzpayment\Repositories\PaymentRepository;

class PaymentController extends Controller
{
	protected $payment;
    
	public function __construct(PaymentRepository $payment)
    {
       $this->payment = $payment;	   
    }
    
    public function payNow(Order $order, Request $request)
    {
    	
        $orderId = $order->id;                
        $amount = $order->amount;        
        
        $onlineCharge = number_format(($this->payment->getOnlineCharge()*$amount), 2, '.', '');
        $totalAmount = $amount + $onlineCharge;
        

        $user = $request->user();          
        //$name = $user->name;
        //$email = $user->email;

        $order = [
            'order_id' => $orderId,
            'schedule_id' => $order->schedule_id,
            'travel_date' => date("d-m-Y", strtotime($order->date)),
            'total_amount' => $totalAmount
        ];

        //$this->payment->setSessionFororderInfo($order, $this->request); 
        $this->payment->setSessionForOrderInfo($order, $request); 

        
        
        $sandbox = config('sslcommerzpayment.sslcommerz.sandbox');
        $gwUrl = ($sandbox) ? config('sslcommerzpayment.sslcommerz.sandbox_url') : config('sslcommerzpayment.sslcommerz.live_url');             

        return view('sslcommerzpayment.payment', compact(
                        'gwUrl', 
                        'orderId', 
                        'amount',
                        'onlineCharge',
                        'totalAmount', 
                        'user'
                        
                ));
    }

}