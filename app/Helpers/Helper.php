<?php

use Illuminate\Support\Facades\Storage;

/**
 * Get an image from storage or return a placeholder
 */
if (!function_exists('get_image_or_placeholder')) {
    function get_image_or_placeholder($path, $placeholder = '/img/noimage.webp')
    {
        if ($path && Storage::disk('public')->exists($path)) {
            return asset('storage/' . $path);
        } else {
            return asset($placeholder);
        }
    }
}

/**
 * Count and display cart total
 */
if (!function_exists('cart_total')) {
    function cart_total() {
        $total = 0;
        foreach (session('cart', []) as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}