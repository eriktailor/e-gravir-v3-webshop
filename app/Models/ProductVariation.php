<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    protected $fillable = [
        'product_id', 
        'name', 
        'value', 
        'price', 
        'in_stock',
        'order'
    ];

    /**
     * Make relation with Product model
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
