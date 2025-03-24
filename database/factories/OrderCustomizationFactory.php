<?php

namespace Database\Factories;

use App\Models\OrderCustomization;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderCustomizationFactory extends Factory
{
    protected $model = OrderCustomization::class;

    public function definition()
    {
        return [
            'order_id' => \App\Models\Order::factory(),
            'product_id' => Product::inRandomOrder()->first()->id, // <<< EZ HIÁNYZOTT!

            'front_image' => $this->faker->imageUrl,
            'front_text' => $this->faker->sentence,
            'back_image' => $this->faker->imageUrl,
            'back_text' => $this->faker->sentence,
            'inner_text' => $this->faker->sentence,
            'other_notes' => $this->faker->sentence,
        ];
    }
}
