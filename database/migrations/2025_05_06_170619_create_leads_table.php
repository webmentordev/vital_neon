<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string("uuid");
            $table->string("name")->nullable();
            $table->string("email")->nullable();
            $table->string("phone_number")->nullable();
            $table->string("location")->nullable();
            $table->string("dimensions")->nullable();
            $table->string("budget")->nullable();
            $table->text("message")->nullable();
            $table->string("logos")->nullable();
            $table->boolean("is_completed")->default(false);
            $table->text("user_agent")->nullable();
            $table->string("source")->nullable();
            $table->string("ip_address")->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
