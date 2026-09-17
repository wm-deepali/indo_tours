<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_seo_fields_to_sub_categories_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sub_categories', function (Blueprint $table) {
            $table->string('robots')->nullable()->after('canonical_url');
            $table->string('twitter_title')->nullable()->after('robots');
            $table->text('twitter_description')->nullable()->after('twitter_title');
            $table->string('twitter_card_image')->nullable()->after('twitter_description');
        });
    }

    public function down(): void
    {
        Schema::table('sub_categories', function (Blueprint $table) {
            $table->dropColumn(['robots', 'twitter_title', 'twitter_description', 'twitter_card_image']);
        });
    }
};