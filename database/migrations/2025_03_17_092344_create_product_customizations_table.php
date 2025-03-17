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
        Schema::create('product_customizations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->boolean('front_image')->default(0);
            $table->boolean('front_text')->default(0);
            $table->boolean('back_image')->default(0);
            $table->boolean('back_text')->default(0);
            $table->boolean('inner_image')->default(0);
            $table->boolean('inner_text')->default(0);
            $table->boolean('other_notes')->default(0);
            $table->integer('back_extra_price')->nullable();
            $table->integer('inner_extra_price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_customizations');
    }
};
