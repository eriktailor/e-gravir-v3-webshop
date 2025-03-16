<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'price',
        'sale_price',
        'tags',
        'short_description',
        'description',
        'in_stock',
        'menu_order',
        'is_visible',
        'featured',
        'category_id',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public function tags(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? explode(',', $value) : [],
            set: fn ($value) => is_array($value) ? implode(',', $value) : $value,
        );
    }
}
