<?php
 
namespace Mahmed99\Sslcommerzpayment\Repositories;

use Illuminate\Http\Request;
 
interface PaymentRepositoryInterface
{
    public function action(Request $request);
}