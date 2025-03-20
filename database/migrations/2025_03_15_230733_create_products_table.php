<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price');
            $table->integer('sale_price')->nullable();
            $table->integer('extra_price')->nullable();
            $table->string('tags')->nullable(); // Comma-separated values
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->integer('in_stock')->default(0);
            $table->integer('menu_order')->nullable();
            $table->boolean('hidden')->default(true); // Active/Inactive
            $table->boolean('featured')->default(false); // Is featured?
            $table->foreignId('category_id')->constrained('product_categories')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
