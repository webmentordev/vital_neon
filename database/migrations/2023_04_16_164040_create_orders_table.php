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
            $table->string('quantity');
            $table->decimal('price', 10, 2);
            $table->string('slug');
            $table->string('name');
            $table->string('details');
            $table->string('address_id');
            $table->text('checkout_id');
            $table->string('status')->default('pending');
            $table->string('shipping')->default('Processing');
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
