<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'id' => 1,                
                'name' => 'Keskeny slim gravírozott pénztárca',
                'slug' => 'keskeny-slim-gravirozott-penztarca',
                'price' => 11990,
                'sale_price' => null,
                'extra_price' => 2900,
                'tags' => 'lapos kivitelezés,élesebb gravírozás,közkedvelt',
                'short_description' => 'Vékony, zsebben hordható, karcsúsított pénztárca PU bőr anyagból.',
                'description' => null,
                'in_stock' => 12,
                'menu_order' => 10,
                'hidden' => 0,
                'featured' => 0,
                'category_id' => 1,
            ],
            [
                'id' => 2,
                'name' => 'Kis sima gravírozott pénztárca',
                'slug' => 'kis-sima-gravirozott-penztarca',
                'price' => 13990,
                'sale_price' => 10000,
                'extra_price' => 2900,
                'tags' => 'valódi bőr,kompakt,Wild pénztárca',
                'short_description' => 'Hagyományos elrendezésű, normál méretű, valódi bőr pénztárca, egyedi gravírozással.',
                'description' => null,
                'in_stock' => 8,
                'menu_order' => 20,
                'hidden' => 0,
                'featured' => 0,
                'category_id' => 1,
            ],
            [
                'id' => 3,
                'name' => 'Függőleges csatos gravírozott pénztárca',
                'slug' => 'fuggoleges-csatos-gravirozott-penztarca',
                'price' => 14990,
                'sale_price' => null,
                'extra_price' => 2900,
                'tags' => 'valódi bőr,férfias pénztárca,Wild pénztárca',
                'short_description' => 'Függőleges elrendezésű, valódi bőr pénztárca, egyedi gravírozással.',
                'description' => null,
                'in_stock' => 5,
                'menu_order' => 30,
                'hidden' => 0,
                'featured' => 0,
                'category_id' => 1,
            ],
            [
                'id' => 4,
                'name' => 'Nagy csatos gravírozott pénztárca',
                'slug' => 'nagy-csatos-gravirozott-penztarca',
                'price' => 14990,
                'sale_price' => null,
                'extra_price' => 2900,
                'tags' => 'valódi bőr,férfias kivitelezés,Wild pénztárca',
                'short_description' => 'Hagyományos elrendezésű, nagy méretű, valódi bőr pénztárca, egyedi gravírozással.',
                'description' => null,
                'in_stock' => 2,
                'menu_order' => 40,
                'hidden' => 0,
                'featured' => 1,
                'category_id' => 1,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
