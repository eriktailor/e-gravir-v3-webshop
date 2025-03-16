<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Pénztárcák',
                'slug' => 'gravirozott-penztarcak',
                'parent_id' => null,
                'image' => '/storage/categories/1/penztarcak.webp',
                'description' => 'Egyedileg, saját fénykép alapján gravírozott, kiváló minőségű bőr férfi pénztárcák. Tökéletes ajándék apáknak, férjeknek, pároknak.',
                'order' => 1,
            ],
            [
                'name' => 'Kisállat kellékek',
                'slug' => 'gravirozott-kisallat-kellekek',
                'parent_id' => null,
                'image' => '/storage/categories/2/kisallat_kellekek.webp',
                'description' => 'Személyre szabott gravírozott kisállat biléták és kiegészítők, hogy kedvenced stílusos és biztonságban legyen!',
                'order' => 2,
            ],
            [
                'name' => 'Acél ékszerek',
                'slug' => 'gravirozott-acel-ekszerek',
                'parent_id' => null,
                'image' => '/storage/categories/3/acel_ekszerek.webp',
                'description' => 'Tartós, rozsdamentes acél ékszerek egyedi gravírozással – neveddel, dátummal vagy különleges üzenettel díszítve.',
                'order' => 3,
            ],
            [
                'name' => 'Emléktárgyak',
                'slug' => 'gravirozott-emlektargyak',
                'parent_id' => null,
                'image' => '/storage/categories/4/emlektargyak.webp',
                'description' => 'Különleges gravírozott emléktárgyak fotóval vagy üzenettel, hogy az emlékek örökre megmaradjanak.',
                'order' => 4,
            ],
        ];

        foreach ($categories as $category) {
            ProductCategory::create($category);
        }
    }
}
