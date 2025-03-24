<?php

namespace Database\Factories;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition()
    {
        return [
            'product_id' => \App\Models\Product::inRandomOrder()->first()->id,
            'product_name' => $this->faker->word,
            'product_price' => rand(5000, 15000),
            'customizations' => json_encode([
                'front_image' => $this->faker->boolean,
                'front_text' => $this->faker->words(3, true),
                'back_image' => $this->faker->boolean,
                'inner_text' => $this->faker->words(2, true),
            ]),
        ];
    }
}