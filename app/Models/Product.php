<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
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
}
