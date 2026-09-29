<?php
// database/migrations/2026_09_29_000002_add_journey_story_fields_to_blogs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->boolean('is_journey_story')->default(false)->after('tag');
            $table->string('card_title')->nullable()->after('is_journey_story'); // e.g. "Manali" (short name for card)
            $table->unsignedInteger('journey_sort_order')->default(0)->after('card_title');
        });
    }

    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn(['is_journey_story', 'card_title', 'journey_sort_order']);
        });
    }
};