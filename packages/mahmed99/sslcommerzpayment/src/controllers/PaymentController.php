<?php

namespace Mahmed99\Sslcommerzpayment\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Order;
use App\User;
use App\GuestUser;
use App\Payment;
use App\Seat;
use App\SslcommerzPayment;
use GuzzleHttp\Client;

use App\Repositories\Payment\PaymentRepository;

class PaymentController extends Controller
{
	//protected $request;
    protected $payment;
 //    protected $bookingId;
 //    protected $scheduleId;
 //    protected $travelDate;
	// protected $totalAmount;



    //public function __construct(PaymentRepository $payment, Request $request)
	public function __construct(PaymentRepository $payment)
    {
       $this->payment = $payment;
	   //$this->request = $request;
    }

    /*
    bookingId as setInvoiceNumber
    user_id as customerId
    amount as amount
    */
    public function payNow(Booking $booking, Request $request)
    {
    	
        $bookingId = $booking->id;                
        $amount = $booking->amount;        
        //$onlineCharge = ($this->payment->getOnlineCharge()*$amount); //3.5%
        $onlineCharge = number_format(($this->payment->getOnlineCharge()*$amount), 2, '.', '');
        $totalAmount = $amount + $onlineCharge;
        

        $user = $this->payment->findUserInfo($booking->user_id);        
        //$user = User::find($booking->user_id);
        //$name = $user->name;
        //$email = $user->email;

        $booking = [
            'booking_id' => $bookingId,
            'schedule_id' => $booking->schedule_id,
            'travel_date' => date("d-m-Y", strtotime($booking->date)),
            'total_amount' => $totalAmount
        ];

        //$this->payment->setSessionForBookingInfo($booking, $this->request); 
        $this->payment->setSessionForBookingInfo($booking, $request); 

        //create Session for $bookingId, $amount, $totalAmount
        /*$this->request->session()->put('booking_id', $bookingId);
        $this->request->session()->put('schedule_id', $booking->schedule_id);
        $this->request->session()->put('travel_date', date("d-m-Y", strtotime($booking->date)));
        //$this->request->session()->put('amount', $amount);
        $this->request->session()->put('total_amount', $totalAmount);*/

        //$gwUrl = 'https://sandbox.sslcommerz.com/gwprocess/v3/process.php'; 
        
        $sandbox = config('payment.sslcommerz.sandbox');
        $gwUrl = ($sandbox) ? config('payment.sslcommerz.sandbox_url') : config('payment.sslcommerz.live_url');             

        return view('payment.payment', compact(
                        'gwUrl', 
                        'bookingId', 
                        'amount',
                        'onlineCharge',
                        'totalAmount', 
                        'user'
                        
                ));
    }


    /*public function removeSeatBookedOrBuyingStatus($bookingId, $scheduleId, $travelDate){
        // by Deleting from bookings, seats table

        Booking::destroy($bookingId); // deleting by pk

        $seats = Seat::where('booking_id', $bookingId)->get();            
            foreach ($seats as $seat) {
                $updateSeatInfo = [
                        'seat_no' => $seat->seat_no,
                        'status' => 'available',
                    ];
                $seat->delete();
                $updateSeatInfo = json_decode(json_encode($updateSeatInfo), FALSE); //array to object
                broadcast(new SeatStatusUpdatedEvent($updateSeatInfo, $scheduleId, $travelDate))->toOthers();
            }
        return;
    }*/

    public function updateSeatStatus($bookingId, $scheduleId, $travelDate)
    {
        $seats = Seat::where('booking_id', $bookingId)->get();            
            foreach ($seats as $seat) {
                $seat->update([
                        'status' => 'confirmed',
                    ]);
                broadcast(new SeatStatusUpdatedEvent($seat, $scheduleId, $travelDate))->toOthers();
            }
        return;
    }

    public function success(Request $request)
    {
     
       // 1. validate the transaction
                // Restore data from session as submited data
                /* $bookingId = $this->request->session()->get('booking_id');
                    $bookingId = session('booking_id');

                    //$amount = $this->request->session()->get('amount');
                    $totalAmount = $this->request->session()->get('total_amount');
                */
            $bookingId = session('booking_id');
            $scheduleId = session('schedule_id');
            $travelDate = session('travel_date');            
            $totalAmount = session('total_amount');

            // GW 
            $payment_status = 'unknown';
            $tran_id = isset($request->tran_id) ? $request->tran_id : null;                      

            if ($tran_id !== null && strlen($tran_id) > 0) {
                
                $payment_data = $request->all(); // all of the input data as an array
                $val_id = $request->val_id;
                $amount = $request->amount;
                $store_amount = $request->store_amount;
                $card_type = $request->card_type;
                $card_no = $request->card_no;                

                if ($totalAmount == $amount) {
                    //$username = 'demotest';
                    $storeId = 'testbox';
                    $password = 'qwerty';

                    $val_id = urlencode($val_id);
                    $store_id = urlencode($storeId);
                    $store_passwd=urlencode($password);
                    
                    $sandbox = true;

                    $url = ($sandbox) ? 'https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php' 
                                        : 'https://securepay.sslcommerz.com/validator/api/validationserverAPI.php';

                    $requested_url = ($url . "?val_id=".$val_id."&Store_Id=".$store_id."&Store_Passwd=".$store_passwd."&v=1&format=json");
                    
                    $handle = curl_init();

                    curl_setopt($handle, CURLOPT_URL, $requested_url);
                    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
                    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
                    
                    $response = curl_exec($handle);

                    //dd($response);
                    
                    $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
                    if( $code == 200 && !(curl_errno($handle))) {
                        $result = json_decode($response); // json TO CONVERT AS OBJECT
                        //dd($result);

                        # TRANSACTION INFO
                        $status = $result->status;
                        $tran_date = $result->tran_date;
                        $tran_id = $result->tran_id;
                        $val_id = $result->val_id;
                        $amount = $result->amount;                        
                        $store_amount = $result->store_amount;
                        $bank_tran_id = $result->bank_tran_id;
                        $card_type = $result->card_type;

                        # ISSUER INFO
                        $card_no = $result->card_no;
                        $card_issuer = $result->card_issuer;
                        $card_brand = $result->card_brand;
                        $card_issuer_country = $result->card_issuer_country;
                        $card_issuer_country_code = $result->card_issuer_country_code;

                        # API AUTHENTICATION 
                        $apiconnect = $result->APIConnect; 
                        $validated_on = $result->validated_on;
                        $gw_version = $result->gw_version;

                        if (in_array(strtoupper($apiconnect), ['INVALID_REQUEST', 'FAILED', 'INACTIVE'] ) ) {
                            $payment_status = 'failed';
                        } elseif (in_array(strtoupper($status), ['INVALID_TRANSACTION'] ) ) {
                            $payment_status = 'failed';
                        } elseif (in_array(strtoupper($status), ['VALIDATED', 'VALID'] ) ) {
                            $payment_status = 'success';
                        } else {
                            $payment_status = 'unknown';
                        }

                        $validation_data = json_decode($response, true ); // json (convert) to array
                    } else {
                        $validation_data = [
                            'error' => 'Payment was successful. Could not connect to validation server!'
                        ];
                    }
                    curl_close($handle);

                    // If there's a flight from Oakland to San Diego, set the price to $99.
                    // If no matching model exists, create one.
                    // $flight = App\Flight::updateOrCreate(
                    //     ['departure' => 'Oakland', 'destination' => 'San Diego'],
                    //     ['price' => 99]
                    // );

                    // SslcommerzPayment::create([
                    //     'booking_id' => $bookingId,
                    //     'total_amount' => $totalAmount,
                    //     'payment_data' => $payment_data,
                    //     'validation_data' => $validation_data,
                    //     'validation_date' => date('Y-m-d H:i:s'),
                    //     'payment_status' => $payment_status,
                    // ]);

                    SslcommerzPayment::updateOrCreate(
                        ['booking_id' => $bookingId],
                        ['total_amount' => $totalAmount,
                        'payment_data' => $payment_data,
                        'validation_data' => $validation_data,
                        'validation_date' => date('Y-m-d H:i:s'),
                        'payment_status' => $payment_status
                        ]
                    );

                }
                
                // validatio message
                $validation_message = '';
                if (isset($validation_data['error'])) {
                    $validation_message = $validation_data['error'];
                } else {
                    if ($payment_status != 'success') {
                        $validation_message = 'Some error validating the payment! Please contact the administrator to validate the payment manually.';
                    }
                    else {
                        $this->updateSeatStatus($bookingId, $scheduleId, $travelDate);
                    }

                }
            }


            //2. store to data base 
                //$bookingId, $totalAmount
                // $payment_data, $validation_data
        //3. updateSeatStatus 

        //clear session
       //$this->request->session()->forget('booking_id');
        //$this->request->session()->forget('amount');
       //$this->request->session()->forget('total_amount');


        return view('payment.success', compact('payment_status', 'validation_message', 'status', 'tran_id', 'val_id', 'store_amount', 'amount'));
        //return $request;
    }
    
    public function fail(Request $request)
    {
        $bookingId = session('booking_id');
        $totalAmount = session('total_amount');
       // return 'FAILED';
        $payment_status = 'failed';
        $tran_id = isset($request->tran_id) ? $request->tran_id : null; 
        if ($tran_id !== null && strlen($tran_id) > 0) {
            $payment_data = $request->all(); // all of the input data as an array

            $validation_data = array(
                'error' => ( isset($request->error) ? $request->error : 'Payment returned to fail page' )
            );

            SslcommerzPayment::create([
                'booking_id' => $bookingId,
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
        //1. store to data base 
        // 2. removeSeatBookedOrBuyingStatus

       return view('payment.failed', compact('validation_message', 'bookingId'));
    }

    public function cancel(Request $request)
    {
        $bookingId = session('booking_id');
        $totalAmount = session('total_amount');

        $payment_status = 'cancelled';
        $tran_id = isset($request->tran_id) ? $request->tran_id : null; 
        
        if ($tran_id !== null && strlen($tran_id) > 0) {
            $payment_data = $request->all(); // all of the input data as an array

            $validation_data = array(
                'error' => (isset($request->error) ? $request->error : 'User cancelled payment')
            );

            SslcommerzPayment::create([
                'booking_id' => $bookingId,
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
                $validation_message = 'Payment cancelled';
            }
        }

        return view('payment.cancelled', compact('validation_message', 'bookingId'));
    }

    public function payNow2(Booking $booking)
    {
        $bookingId = $booking->id;        
        $client = new Client();       
        $client->request('POST', 'https://sandbox.sslcommerz.com/gwprocess/v3/process.php', [
            'form_params' => [
                'total_amount' => '1150.00',
                'store_id' => 'testbox',
                'tran_id' => $bookingId,
                'success_url' => route('success'),            
                'fail_url' => route('fail'), //http://localhost/api/payment/fail',
                'cancel_url' => 'http://localhost/payment/cancel/F9997499',
                'cus_name' => 'ABC XYZ',               
                'cus_email' => 'abc.xyz@mail.com',             
                'version' => '3.0.0',
                'submit' => 'Pay+Now'              
            ]
        ]);
    }


}