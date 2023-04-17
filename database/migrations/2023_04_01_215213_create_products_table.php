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
            $table->string('stripe_id');
            $table->foreignId('category_id');
            $table->string('name');
            $table->text('body');
            $table->text('image');
            $table->string('slug');
            $table->text('description');
            $table->boolean('featured')->default(false);
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
