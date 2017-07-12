<?php

namespace Mahmed99\Sslcommerzpayment\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
     public function index()
    {
        return view('sslcommerzpayment::test');
    }
}
