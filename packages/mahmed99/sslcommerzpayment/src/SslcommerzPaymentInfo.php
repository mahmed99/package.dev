<?php 

namespace Mahmed99\Sslcommerzpayment;

use Mahmed99\Sslcommerzpayment\Model\SslcommerzPayment;


class SslcommerzPaymentInfo 
{
    public static function paymentData($orderId)
    {
      $paymentData = SslcommerzPayment::where('order_id', $orderId)->pluck('payment_data');
      return $paymentData;
       //return 'You used the TestFacade to call this method!';
    }

    public static function validationData($orderId)
    {
        return 'You used the TestFacade to call this method!';
    }
}