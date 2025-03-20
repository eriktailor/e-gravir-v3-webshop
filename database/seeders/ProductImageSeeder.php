<?php

namespace Database\Seeders;

use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productSlugs = [
            1 => 'keskeny_slim',
            2 => 'kis_sima',
            3 => 'fuggoleges',
            4 => 'nagy_csatos',
        ];

        $images = [];
        
        foreach ($productSlugs as $productId => $slug) {
            $folder = "products/{$productId}";
            $files = Storage::disk('public')->files($folder);
        
            $order = 1;
            foreach ($files as $file) {
                // Optional: filter by extension if needed (only .webp)
                if (!str_ends_with($file, '.webp')) continue;
        
                $images[] = [
                    'product_id' => $productId,
                    'image_path' => $file,
                    'order' => $order++,
                ];
            }
        }
        
        ProductImage::insert($images);
    }
}
