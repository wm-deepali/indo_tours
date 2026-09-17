<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->string('h1')->nullable()->after('sort_order');
            $table->string('meta_title')->nullable()->after('h1');
            $table->text('meta_description')->nullable()->after('meta_title');
            $table->string('canonical_url')->nullable()->after('meta_description');
            $table->string('robots')->nullable()->after('canonical_url');
            $table->string('og_title')->nullable()->after('robots');
            $table->text('og_description')->nullable()->after('og_title');
            $table->string('og_image')->nullable()->after('og_description');
            $table->string('twitter_card_image')->nullable()->after('og_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn([
                'h1',
                'meta_title',
                'meta_description',
                'canonical_url',
                'robots',
                'og_title',
                'og_description',
                'og_image',
                'twitter_card_image'
            ]);
        });
    }
};
