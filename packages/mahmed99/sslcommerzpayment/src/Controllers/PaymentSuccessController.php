<?php

namespace Mahmed99\Sslcommerzpayment\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mahmed99\Sslcommerzpayment\Events\PaymentSuccess;
use Mahmed99\Sslcommerzpayment\Repositories\PaymentRepositoryInterface;

class PaymentSuccessController extends Controller
{
    protected $payment;

    public function __construct(PaymentRepositoryInterface $payment)
    {
    	$this->payment = $payment;
    }

    public function payment(Request $request)
    {
    	$paymentInfo = $this->payment->action($request);

    	extract($paymentInfo);

        $order = Order::findOrFail($orderId);

        event(new PaymentSuccess($order));

    	return view('sslcommerzpayment::success', compact('payment_status', 'validation_message', 'status', 'tran_id', 'bank_tran_id', 'tran_date', 'store_amount', 'amount', 'card_type', 'currency'));	
    }
}