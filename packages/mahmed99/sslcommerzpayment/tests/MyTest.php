<?php

namespace Mahmed99\Sslcommerzpayment\Test;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Mahmed99\Sslcommerzpayment\Facades\SslcommerzpaymentFacade;

class MyTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        //$this->assertTrue(true);
        $this->assertSame(SslcommerzpaymentFacade::multiply(4, 4), 16);
    }

    /** @test **/
    public function multiply_number()
    {
    	$this->assertSame(SslcommerzpaymentFacade::multiply(4, 4), 16);
    }
}