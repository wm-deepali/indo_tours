<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // If any of these columns already exist on your hotels table, remove that line.
        Schema::table('hotels', function (Blueprint $table) {
            $table->unsignedTinyInteger('star_rating')->nullable()->after('rating');
            $table->string('category')->nullable()->after('star_rating');
            $table->longText('description')->nullable()->after('short_description');
            $table->text('address')->nullable()->after('location');

            $table->json('facilities')->nullable();

            $table->text('map_embed_url')->nullable();
            $table->string('map_directions_url', 2048)->nullable();
            $table->json('map_points')->nullable();

            $table->string('h1')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('canonical_url', 2048)->nullable();
            $table->string('robots')->default('index, follow');
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('twitter_card_image')->nullable();
        });

        Schema::create('hotel_rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('room_type')->nullable();          // Standard / Deluxe / Super Deluxe / Suite ...
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('max_adults')->default(2);
            $table->unsignedTinyInteger('max_children')->default(0);
            $table->string('bed_type')->nullable();
            $table->string('room_size')->nullable();
            $table->json('amenities')->nullable();
            $table->decimal('old_price', 10, 2)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('price_unit')->default('per night');
            $table->string('tax_note')->nullable();
            $table->boolean('is_active')->default(true);      // show on website
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('hotel_room_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_room_id')->constrained('hotel_rooms')->cascadeOnDelete();
            $table->string('image');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotel_room_images');
        Schema::dropIfExists('hotel_rooms');

        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn([
                'star_rating', 'category', 'description', 'address', 'facilities',
                'map_embed_url', 'map_directions_url', 'map_points',
                'h1', 'meta_title', 'meta_description', 'canonical_url', 'robots',
                'og_title', 'og_description', 'og_image', 'twitter_card_image',
            ]);
        });
    }
};