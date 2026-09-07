<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();

            // Location hierarchy - a destination can be country-only,
            // country+state, or country+state+city.
            $table->foreignId('country_id')->constrained('countries')->cascadeOnDelete();
            $table->foreignId('state_id')->nullable()->constrained('states')->nullOnDelete();
            $table->foreignId('city_id')->nullable()->constrained('cities')->nullOnDelete();

            // Basic info
            $table->string('name');                 // "Kashmir"
            $table->string('slug')->unique();
            $table->string('image')->nullable();     // listing card + banner fallback image

            // Descriptions
            $table->string('short_description')->nullable(); // shown on listing page card
            $table->longText('description')->nullable();     // long description on detail page
            $table->string('more_about_intro')->nullable(); // the subtitle line under "More About X"
            $table->longText('more_about_content')->nullable(); // the HTML block itself
            $table->string('verdict_title')->nullable();
            $table->string('recommended_for')->nullable();
            $table->string('why_visit_image')->nullable();
            $table->string('why_visit_media_tag')->nullable();

            // Facts panel
            $table->string('duration_text')->nullable();   // "5-7 Days"
            $table->string('best_time_text')->nullable();  // "March - October"
            $table->string('budget_text')->nullable();     // "₹25K - ₹60K+"
            $table->json('best_for_tags')->nullable();     // ["Couples","Families","Nature","Adventure"]
            $table->json('season_highlights')->nullable(); // [{label, value}, ...] — "Best overall: March–October" etc
            $table->string('budget_intro_text')->nullable(); // e.g. "Estimated per-person budget for a 7-day trip"
            $table->text('budget_note')->nullable();

            // Status & ordering
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->enum('status', ['draft', 'published', 'unpublished'])->default('draft');

            // SEO fields (auto-filled, editable per admin spec)
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
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};