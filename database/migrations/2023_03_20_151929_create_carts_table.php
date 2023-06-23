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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->string('jacket');
            $table->string('font');
            $table->string('color');
            $table->string('backboard');
            $table->string('location');
            $table->string('align');
            $table->string('adaptor');
            $table->string('remote');
            $table->string('kit');
            $table->bigInteger('phone');
            $table->string('price');
            $table->string('price_id');
            $table->string('email');
            $table->text('order_id');
            $table->string('address');
            $table->string('status')->default('pending');
            $table->boolean('paid')->default(false);
            $table->text('checkout_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
