<?php
 
namespace App\Repositories\Payment;
use Illuminate\Http\Request;
 
interface PaymentRepositoryInterface
{
    public function action(Request $request);
}