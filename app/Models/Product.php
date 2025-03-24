<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'name',
        'slug',
        'price',
        'sale_price',
        'extra_price',
        'tags',
        'short_description',
        'description',
        'in_stock',
        'menu_order',
        'hidden',
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

    /**
     * Get the first image of the product
     */
    public function firstImageUrl()
    {
        return $this->images->first()?->image_path 
            ? asset('storage/' . $this->images->first()->image_path) 
            : asset('/img/noimage.webp');
    }

    /**
     * Auto save product slug (created from product name)
     */
    protected static function booted()
    {
        static::saving(function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }

    /** 
     * Relation with ProductImage model
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('order');
    }

    /**
     * Relation with ProductCategory model
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    /**
     * Relation with ProductVariation model
     */
    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    /**
     * Relation with ProductCustomization model
     */
    public function customization()
    {
        return $this->hasOne(ProductCustomization::class);
    }
}
