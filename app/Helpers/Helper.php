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