<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('submitted_offers', function (Blueprint $table) {
            $table->id();
            $table->string('store_url');
            $table->string('coupon_code')->nullable();
            $table->text('description')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('submitted_offers');
    }
};