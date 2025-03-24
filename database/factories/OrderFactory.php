<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'customer_name' => $this->faker->name,
            'customer_email' => $this->faker->safeEmail,
            'customer_phone' => $this->faker->phoneNumber,
            'customer_zip' => $this->faker->postcode,
            'customer_city' => $this->faker->city,
            'customer_address' => $this->faker->address,
            'delivery_method' => 'foxpost',
            'delivery_foxpost_box' => 'Budapest Box 123',
            'delivery_notes' => $this->faker->sentence,
            'payment_method' => 'barion',
            'products_total' => rand(10000, 30000),
            'extra_price' => rand(500, 1500),
            'delivery_price' => rand(1000, 2000),
            'order_total' => rand(12000, 35000),
            'status' => 'pending',
        ];
    }
}
