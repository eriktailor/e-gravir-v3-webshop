<?php

namespace Database\Seeders;

use App\Models\ProductCustomization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCustomizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customizations = [
            [
                'product_id' => 1,  
                'front_image' => 1,
                'front_text' => 1,
                'back_image' => 1,
                'back_text' => 1,
                'inner_text' => 1,
                'other_notes' => 1
            ],
            [
                'product_id' => 2,  
                'front_image' => 1,
                'front_text' => 1,
                'back_image' => 1,
                'back_text' => 1,
                'inner_text' => 1,
                'other_notes' => 1
            ],
            [
                'product_id' => 3,  
                'front_image' => 1,
                'front_text' => 1,
                'back_image' => 1,
                'back_text' => 1,
                'inner_text' => 1,
                'other_notes' => 1
            ],
            [
                'product_id' => 4,  
                'front_image' => 1,
                'front_text' => 1,
                'back_image' => 1,
                'back_text' => 1,
                'inner_text' => 1,
                'other_notes' => 1
            ], 
        ];

        foreach ($customizations as $customization) {
            ProductCustomization::create($customization);
        }
    }
}
