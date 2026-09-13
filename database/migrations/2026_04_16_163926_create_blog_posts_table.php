<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('title')->nullable();

            $table->text('meta_description')->nullable();
            $table->text('short_description')->nullable();

            $table->longText('description')->nullable();

            $table->string('image')->nullable();

            $table->string('author_name')->nullable();
            $table->string('author_image')->nullable();

            $table->string('badge_text')->nullable();
            $table->string('read_time')->nullable();

            $table->date('published_date')->nullable();

            $table->boolean('is_featured')->default(0);
            $table->boolean('is_featured_article')->default(0);

            $table->enum('status', ['enable', 'disable'])->default('enable');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};