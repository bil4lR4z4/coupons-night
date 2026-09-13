<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('store_id')->nullable();
            $table->unsignedBigInteger('event_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();

            $table->string('product_name', 191);
            $table->string('product_title', 191)->nullable();

            $table->string('old_price', 255)->nullable();
            $table->string('current_price', 255);

            $table->text('detail')->nullable();

            $table->string('image', 191)->nullable();
            $table->string('url', 191)->nullable();

            $table->string('slug', 191)->nullable();

            $table->string('currency_code', 255)->nullable();
            $table->string('currency_symbol', 255)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};