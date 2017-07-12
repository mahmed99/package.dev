<?php

namespace Mahmed99\Sslcommerzpayment\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Payment\PaymentRepositoryInterface;

class PaymentFailedController extends Controller
{
    protected $payment;

    public function __construct(PaymentRepositoryInterface $payment)
    {
    	$this->payment = $payment;
    }

    public function payment(Request $request)
    {
    	$paymentInfo = $this->payment->action($request);

    	extract($paymentInfo); // $payment_status, $validation_message, $bookingId

    	return view('payment.failed', compact('validation_message', 'bookingId'));	
    }
}
