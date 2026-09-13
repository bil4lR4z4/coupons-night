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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            $table->string('site_logo')->nullable();
            $table->string('footer_logo')->nullable();
            $table->string('favicone')->nullable();

            $table->text('site_description')->nullable();

            $table->text('fb_link')->nullable();
            $table->text('insta_link')->nullable();
            $table->text('pinterest_link')->nullable();
            $table->text('x_link')->nullable();
            $table->text('youtube_link')->nullable();
            $table->text('how_to_use')->nullable();
            $table->text('how_to_use_image')->nullable();

            $table->text('why_chose')->nullable();
            $table->text('why_chose_us_image')->nullable();

            $table->longText('offer_description')->nullable();
            $table->text('offer_button')->nullable();
            $table->enum('offer_checkbox', ['active', 'inactive'])->default('inactive');
            $table->text('admin_email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_logs');
    }
};
