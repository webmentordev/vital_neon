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
        Schema::create('light_box_orders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('email');
            $table->string('remote');
            $table->decimal('price', 10, 2);
            $table->text('checkout_id');
            $table->text('url');
            $table->string('status')->default('pending');
            $table->boolean('is_paid')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('light_box_orders');
    }
};
