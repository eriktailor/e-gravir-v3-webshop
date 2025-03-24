<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Customer details
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->string('customer_zip');
            $table->string('customer_city');
            $table->string('customer_address');

            // Delivery options
            $table->string('delivery_method');
            $table->string('delivery_foxpost_box')->nullable();
            $table->text('delivery_notes')->nullable();

            // Payment
            $table->string('payment_method');
            $table->string('barion_status');
            $table->string('barion_pay_id');
            $table->string('bank_status');

            // Pricing
            $table->integer('products_total')->default(0);
            $table->integer('extra_price')->default(0);
            $table->integer('delivery_price')->default(0);
            $table->integer('order_total')->default(0);

            // Order
            $table->string('status')->default('pending');
            $table->text('my_notes')->nullable();
            $table->boolean('accept_terms')->default(0);
            $table->string('invoice_number')->nullable();

            // Timestamps
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
