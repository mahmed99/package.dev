<?php

namespace Mahmed99\Sslcommerzpayment\Events;

use App\Order;
use Illuminate\Queue\SerializesModels;

class PaymentCancelled
{
    use SerializesModels;

    public $order;

    /**
     * Create a new event instance.
     *
     * @param  Order  $order
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
}