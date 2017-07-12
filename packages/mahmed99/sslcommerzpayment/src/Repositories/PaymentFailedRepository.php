<?php 

namespace App\Repositories\Payment;

use App\SslcommerzPayment;
use Illuminate\Http\Request;
//use App\Repositories\Payment\PaymentRepository;


class PaymentFailedRepository implements PaymentRepositoryInterface
{
    
    //protected $request;
    protected $payment;

    public function __construct(PaymentRepository $payment)
    {
       $this->payment = $payment;
	   //$this->request = $request;	   
    }

    public function action(Request $request)
    {
    	$sessionOrderedInfo = $this->payment->getSessionForOrderedInfo();
    	extract($sessionOrderedInfo); //$orderId, $scheduleId, $travelDate, $totalAmount

        // $orderId = session('order_id');
        // $totalAmount = session('total_amount');
       // return 'FAILED';
        $payment_status = 'failed';
        $tran_id = isset($request->tran_id) ? $request->tran_id : null; 
        if ($tran_id !== null && strlen($tran_id) > 0) {
            $payment_data = $request->all(); // all of the input data as an array

            $validation_data = array(
                'error' => ( isset($request->error) ? $request->error : 'Payment returned to fail page' )
            );

            SslcommerzPayment::create([
                'order_id' => $orderId,
                'total_amount' => $totalAmount,
                'payment_data' => $payment_data,
                'validation_data' => $validation_data,
                'validation_date' => date('Y-m-d H:i:s'),
                'payment_status' => $payment_status,
            ]);
        }
        // validatio message
        $validation_message = '';
        if (isset($validation_data['error'])) {
            $validation_message = $validation_data['error'];
        } else {
            if ($payment_status != 'success') {
                $validation_message = 'Could not complete the payment.';
            }
        }  

        return [
        	'payment_status' => $payment_status, 
        	'validation_message' => $validation_message,         	
            'orderId' => $orderId,
        ];
        
    }
}