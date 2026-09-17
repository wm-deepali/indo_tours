<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('blog_category_id')->constrained('blog_categories')->cascadeOnDelete();
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();

            $table->string('title');
            $table->string('slug')->unique();
            $table->string('tag')->nullable(); // e.g. "Travel Guide", "Adventure"

            $table->string('featured_image')->nullable();
            $table->text('short_description')->nullable(); // used on listing cards
            $table->longText('content')->nullable();       // main body, CKEditor

            $table->unsignedBigInteger('views')->default(0);
            $table->date('published_at')->nullable();
            $table->string('status')->default('draft'); // draft | published

            // Related: Destinations
            $table->string('destination_heading')->nullable();
            $table->text('destination_description')->nullable();

            // Related: Attractions
            $table->string('attraction_heading')->nullable();
            $table->text('attraction_description')->nullable();

            // Related: Activities
            $table->string('activity_heading')->nullable();
            $table->text('activity_description')->nullable();

            // Related: Tour Packages
            $table->string('tour_package_heading')->nullable();
            $table->text('tour_package_description')->nullable();

            // SEO
            $table->string('h1')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('canonical_url')->nullable()->unique();
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('twitter_card_image')->nullable();
            $table->string('robots')->default('index,follow');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};