<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('event_id')->nullable();

            $table->string('name')->nullable();
            $table->text('detail')->nullable();
            $table->string('coupon_code')->nullable();

            $table->string('coupon_image_line_1')->nullable();
            $table->string('coupon_image_line_2')->nullable();
            $table->string('coupon_image_line_3')->nullable();

            $table->text('html_code')->nullable();

            $table->enum('date_type', ['text', 'calendar'])->default('text');
            $table->string('date_text')->nullable();

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->boolean('is_exclusive')->default(false);
            $table->boolean('free_shipping')->default(false);
            $table->boolean('is_homepage')->default(false);
            $table->boolean('is_top_category')->default(false);
            $table->boolean('is_special_offer')->default(false);
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_no_code')->default(false);

            $table->integer('rank')->default(0);

            $table->integer('sort_order')->default(0);

            $table->enum('status', ['enable', 'disable'])->default('enable');

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();

            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->nullOnDelete();
            $table->foreign('event_id')->references('id')->on('events')->nullOnDelete();
            $table->foreign('created_by')->references('id')->on('users')->nullOnDelete();
            $table->foreign('updated_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};