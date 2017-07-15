<?php 

namespace Mahmed99\Sslcommerzpayment\Facades;

use Illuminate\Support\Facades\Facade;

class SslcommerzpaymentFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'sslcommerz';
    }
}