<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCustomization extends Model
{
    protected $fillable = [
        'product_id',
        'front_image',
        'front_text',
        'back_image',
        'back_text',
        'inner_image',
        'inner_text',
        'other_notes',
    ];

    /**
     * Make relation with Product model
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
