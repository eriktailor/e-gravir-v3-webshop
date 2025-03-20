<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name',
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
    public function firstImageUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                $image = $this->images->first();
                if ($image && Storage::disk('public')->exists($image->image_path)) {
                    return asset('storage/' . $image->image_path);
                } else {
                    return asset('/img/noimage.webp');
                }
            }
        );
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
