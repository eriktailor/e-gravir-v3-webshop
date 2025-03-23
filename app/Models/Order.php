<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_zip',
        'customer_city',
        'customer_address',
        'delivery_method',
        'delivery_foxpost_box',
        'delivery_notes',
        'payment_method',
        'products_total',
        'extra_fees',
        'delivery_fee',
        'total_amount',
        'status',
    ];

    /**
     * Make relation with OrderCustomization model
     */
    public function customization()
    {
        return $this->hasOne(OrderCustomization::class);
    }
}
