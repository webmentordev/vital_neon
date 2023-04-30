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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id');
            $table->string('location');
            $table->string('adaptor');
            $table->string('remote');
            $table->string('email');
            $table->string('order_id');
            $table->string('kit');
            $table->string('price');
            $table->string('price_id');
            $table->string('checkout_id');
            $table->string('stripe_product');
            $table->text('checkout_url');
            $table->string('phone');
            $table->string('shape');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
