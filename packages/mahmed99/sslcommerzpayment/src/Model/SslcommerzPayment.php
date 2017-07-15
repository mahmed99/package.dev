<?php

namespace Mahmed99\Sslcommerzpayment\Model;

use Illuminate\Database\Eloquent\Model;

class SslcommerzPayment extends Model
{
    protected $fillable = [
        'order_id', 
        'total_amount', 
        'payment_data', 
        'validation_data', 
        'validation_date', 
        'payment_status',
        'edited_by', 
    ];

    public function setPaymentDataAttribute($value)
    {
        $this->attributes['payment_data'] = base64_encode(serialize($value));
    }

    public function getPaymentDataAttribute($value)
    {   
        return unserialize(base64_decode($value));
    }

    public function setValidationDataAttribute($value)
    {
        $this->attributes['validation_data'] = base64_encode(serialize($value));
    }

    public function getValidationDataAttribute($value)
    {
        return unserialize(base64_decode($value));
    }
}