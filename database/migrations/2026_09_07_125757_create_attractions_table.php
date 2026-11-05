<?php
// database/migrations/2026_09_07_000000_create_attractions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('attractions', function (Blueprint $table) {
            $table->id();

            // General
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->string('about_image')->nullable();
            $table->string('short_description', 500)->nullable();
            $table->longText('description')->nullable();
            $table->longText('about_content')->nullable();
            $table->string('about_more_title')->nullable();
            $table->longText('about_more_content')->nullable();
            $table->string('offer_badge_text')->nullable();
            $table->string('offer_title')->nullable();
            $table->text('offer_description')->nullable();
            $table->json('offer_perks')->nullable();
            $table->string('offer_image')->nullable();
            $table->string('offer_button_text')->nullable();
            $table->string('offer_button_url')->nullable();
            $table->string('duration_text', 100)->nullable();
            $table->string('best_time_text', 100)->nullable();
            $table->json('best_for_tags')->nullable();
            $table->decimal('rating', 2, 1)->nullable();
            $table->unsignedInteger('review_count')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->enum('status', ['draft', 'published', 'unpublished'])->default('draft');
            $table->unsignedInteger('sort_order')->default(0);

            // Location
            $table->foreignId('country_id')->constrained('countries');
            $table->foreignId('state_id')->nullable()->constrained('states');
            $table->foreignId('city_id')->nullable()->constrained('cities');
            $table->string('map_location')->nullable();

            // SEO
            $table->string('h1')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('canonical_url')->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();

            $table->string('promo_eyebrow')->nullable();
            $table->string('promo_title')->nullable();
            $table->text('promo_description')->nullable();
            $table->string('promo_button_text')->nullable();
            $table->string('promo_button_url')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attractions');
    }
};