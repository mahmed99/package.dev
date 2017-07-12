<?php 

namespace Mahmed99\Sslcommerzpayment\Repositories;

use App\SslcommerzPayment;
use Illuminate\Http\Request;
//use App\Repositories\Payment\PaymentRepository;


class PaymentSuccessRepository implements PaymentRepositoryInterface
{
    
    //protected $request;
    protected $payment;

    public function __construct(PaymentRepository $payment )
    {
       $this->payment = $payment;
	   //$this->request = $request;
	   //$this->getCredentials();
    }
    
    public function getCredentials()
    {
    	# collect info like storeid, password from settings table or env file
    }

    public function action(Request $request)
    {
         // 1. validate the transaction
        	$sessionOrderedInfo = $this->payment->getSessionForOrderedInfo();
        	extract($sessionOrderedInfo); //$orderId, $totalAmount

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
                    
                    $storeId = config('sslcommerzpayment.sslcommerz.store_id');
                    $password = config('sslcommerzpayment.sslcommerz.store_password');                 

                    $val_id = urlencode($val_id);                                        
                    $store_id = urlencode($storeId);
                    $store_passwd=urlencode($password);
                    
                    $sandbox = true;

                    $url = ($sandbox) ? config('sslcommerzpayment.sslcommerz.sandbox_validation_url') :
                                        config('sslcommerzpayment.sslcommerz.live_validation_url');

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
                    
                    // SslcommerzPayment::create([
                    //     'order_id' => $orderId,
                    //     'total_amount' => $totalAmount,
                    //     'payment_data' => $payment_data,
                    //     'validation_data' => $validation_data,
                    //     'validation_date' => date('Y-m-d H:i:s'),
                    //     'payment_status' => $payment_status,
                    // ]);

                    SslcommerzPayment::updateOrCreate(
                        ['order_id' => $orderId],
                        ['total_amount' => $totalAmount,
                        'payment_data' => $payment_data,
                        'validation_data' => $validation_data,
                        'validation_date' => date('Y-m-d H:i:s'),
                        'payment_status' => $payment_status
                        ]
                    );

                }
                
                // validation message
                $validation_message = '';
                if (isset($validation_data['error'])) {
                    $validation_message = $validation_data['error'];
                } else {
                    if ($payment_status != 'success') {
                        $validation_message = 'Some error validating the payment! Please contact the administrator to validate the payment manually.';
                    }
                }
            }

        return [
        	'payment_status' => $payment_status, 
        	'validation_message' => $validation_message, 
        	'status' => $status, 
        	'tran_id' => $tran_id, 
        	'val_id' => $val_id, 
        	'store_amount' => $store_amount, 
        	'amount' => $amount
        ];
        
    }
}