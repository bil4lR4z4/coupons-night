<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('permissions')) {
            Schema::create('permissions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->integer('category')->default(0);
                $table->integer('network')->default(0);
                $table->integer('blog')->default(0);
                $table->integer('store')->default(0);
                $table->integer('store_approval')->default(0);
                $table->integer('store_report')->default(0);
                $table->integer('slider')->default(0);
                $table->integer('coupon')->default(0);
                $table->integer('product')->default(0);
                $table->integer('event')->default(0);
                $table->integer('store_general_faqs')->default(0);
                $table->integer('best_coupon')->default(0);
                $table->integer('message')->default(0);
                $table->integer('user')->default(0);
                $table->integer('user_activity')->default(0);
                $table->integer('submitted_offer')->default(0);
                $table->integer('theme_setting')->default(0);
                $table->integer('site_setting')->default(0);
                $table->integer('home_setting')->default(0);
                $table->integer('term')->default(0);
                $table->integer('help')->default(0);
                $table->integer('affiliate')->default(0);
                $table->integer('disclaimer')->default(0);
                $table->integer('privacy')->default(0);
                $table->integer('faqs')->default(0);
                $table->integer('marque')->default(0);
                $table->integer('upcoming_event')->default(0);
                $table->integer('geo_restriction')->default(0);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};