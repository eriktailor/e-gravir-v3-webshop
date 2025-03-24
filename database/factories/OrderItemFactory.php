<?php

namespace Database\Factories;

use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition()
    {
        return [
            'product_id' => Product::factory(),
            'product_name' => $this->faker->word,
            'product_price' => rand(5000, 15000),
            'quantity' => rand(1, 3),
            'customizations' => json_encode([
                'front_image' => $this->faker->boolean,
                'front_text' => $this->faker->words(3, true),
                'back_image' => $this->faker->boolean,
                'inner_text' => $this->faker->words(2, true),
            ]),
        ];
    }
}
