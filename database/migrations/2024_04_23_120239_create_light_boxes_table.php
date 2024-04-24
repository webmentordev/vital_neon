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
        Schema::create('light_boxes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('stripe_id');
            $table->string('type')->default('lightbox');
            $table->text('slug');
            $table->text('body');
            $table->text('light_image');
            $table->text('dark_image')->nullable();
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('light_boxes');
    }
};
