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
        $product = Product::inRandomOrder()->first();

        return [
            'product_id' => $product->id,
            'product_name' => $product->name,
            'product_price' => $product->price,
            'customizations' => json_encode([
                'front_image' => $this->faker->boolean,
                'front_text' => $this->faker->words(3, true),
                'back_image' => $this->faker->boolean,
                'inner_text' => $this->faker->words(2, true),
            ]),
        ];
    }
}