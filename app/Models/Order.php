<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_name', 
        'customer_email', 
        'status'
    ];

    /**
     * Make relation with OrderCustomization model
     */
    public function customization()
    {
        return $this->hasOne(OrderCustomization::class);
    }
}
