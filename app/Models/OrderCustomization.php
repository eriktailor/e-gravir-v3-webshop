<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderCustomization extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'order_id',
        'front_image', 'front_text',
        'back_image', 'back_text',
        'inner_image', 'inner_text',
        'other_notes',
        'back_extra_price',
        'inner_extra_price',
    ];
    
    /**
     * Make relation with Order model
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
