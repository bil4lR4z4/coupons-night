<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('slug')->nullable();

            $table->string('secondary_name')->nullable();
            $table->string('heading_h1')->nullable();
            $table->string('heading_h2')->nullable();

            $table->string('domain')->nullable();
            $table->longtext('about')->nullable();
            $table->string('store_url')->nullable();

            $table->unsignedBigInteger('replace_store_id')->nullable();

            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('address')->nullable();

            $table->string('facebook_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('google_plus_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('pinterest_url')->nullable();
            $table->string('wikipedia_url')->nullable();

            $table->string('products_name')->nullable();

            $table->boolean('shipping')->default(false);

            $table->string('iphone_app')->nullable();
            $table->string('android_app')->nullable();

            $table->string('payment_methods')->nullable();

            $table->longText('embed_code')->nullable();

            $table->string('original_url')->nullable();
            $table->string('replace_with_url')->nullable();

            $table->text('impression_code')->nullable();
            $table->text('html_code')->nullable();

            $table->longText('description')->nullable();

            $table->string('store_title')->nullable();

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();

            $table->unsignedBigInteger('network_id')->nullable();
            $table->text('category_id')->nullable();

            $table->string('logo')->nullable();
            $table->string('thumbnail_image')->nullable();

            $table->boolean('is_popular')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_category_featured')->default(false);
            $table->boolean('is_trending')->default(false);
            $table->boolean('is_top')->default(false);

            $table->enum('status', ['enable', 'disable'])->default('disable');

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->boolean('coupon_check')->default(false);

            $table->enum('approval_status', ['draft', 'pending', 'approved', 'rejected'])
                ->default('draft');

            $table->timestamps();

            // Foreign keys (as per typical relational structure)
            $table->foreign('network_id')
                ->references('id')->on('networks')
                ->nullOnDelete();

            // $table->foreign('category_id')
            //     ->references('id')->on('categories')
            //     ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};