<?php

namespace Mahmed99\Sslcommerzpayment\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Payment\PaymentRepositoryInterface;

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

    	return view('payment.success', compact('payment_status', 'validation_message', 'status', 'tran_id', 'val_id', 'store_amount', 'amount'));	
    }
}
