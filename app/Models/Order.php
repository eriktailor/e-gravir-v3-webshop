<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    
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
        'barion_status', 
        'barion_pay_id', 
        'bank_status', 
        'products_total', 
        'extra_price', 
        'delivery_price', 
        'order_total', 
        'status',
        'my_notes',
        'accept_terms',
        'invoice_number',
    ];

    /**
     * Make relation with OrderCustomization model
     */
    public function customization()
    {
        return $this->hasOne(OrderCustomization::class);
    }

    /**
     * Make relation with OrderItem model
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
