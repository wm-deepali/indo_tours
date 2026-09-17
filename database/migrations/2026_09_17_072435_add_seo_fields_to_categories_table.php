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
        Schema::table('categories', function (Blueprint $table) {
            $table->string('robots')->default('index, follow')->after('canonical_url');
            $table->string('twitter_title')->nullable()->after('robots');
            $table->text('twitter_description')->nullable()->after('twitter_title');
            $table->string('twitter_card_image')->nullable()->after('twitter_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['robots', 'twitter_title', 'twitter_description', 'twitter_card_image']);
        });
    }
};