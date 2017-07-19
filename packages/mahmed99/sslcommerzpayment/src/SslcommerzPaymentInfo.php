<?php 

namespace Mahmed99\Sslcommerzpayment;

use Mahmed99\Sslcommerzpayment\Model\SslcommerzPayment;


class SslcommerzPaymentInfo 
{
    public static function paymentData($orderId)
    {
       //return 'You used the TestFacade to call this method!';
      return SslcommerzPayment::where('order_id', $orderId)->pluck('payment_data');
      
    }

    public static function validationData($orderId)
    {
        //return 'You used the TestFacade to call this method!';
      return SslcommerzPayment::where('order_id', $orderId)->pluck('validation_data');
      
      
    }

    public function multiply($a, $b)
    {
        return $a * $b;
    }
}