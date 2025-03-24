<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderCustomization;

class SeedOrders extends Command
{
    protected $signature = 'seed:orders';
    protected $description = 'Seed sample orders with order items and customizations';

    public function handle()
    {
        $this->info('Seeding 3 Orders with 5 OrderItems + 5 OrderCustomizations each...');

        Order::factory(3)->create()->each(function ($order) {
            OrderItem::factory(5)->create([
                'order_id' => $order->id,
            ]);

            \App\Models\OrderCustomization::factory(5)->create([
                'order_id' => $order->id,
            ]);
        });

        $this->info('Seeding completed successfully!');
    }
}
