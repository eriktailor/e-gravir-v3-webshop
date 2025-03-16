<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
