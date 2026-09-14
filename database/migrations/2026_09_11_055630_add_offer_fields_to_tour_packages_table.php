<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_offer_fields_to_tour_packages_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tour_packages', function (Blueprint $table) {
            // Group Offer Banner
            $table->string('group_offer_badge_text')->nullable()->after('map_embed_url');
            $table->string('group_offer_title')->nullable()->after('group_offer_badge_text');
            $table->text('group_offer_description')->nullable()->after('group_offer_title');
            $table->string('group_offer_button1_text')->nullable()->after('group_offer_description');
            $table->string('group_offer_button1_url')->nullable()->after('group_offer_button1_text');
            $table->string('group_offer_image')->nullable()->after('group_offer_button1_url');

            // Promo / Countdown Sale — same pattern as SubCategory
            $table->string('promo_badge_text')->nullable()->after('group_offer_image');
            $table->string('promo_title')->nullable()->after('promo_badge_text');
            $table->text('promo_description')->nullable()->after('promo_title');
            $table->string('promo_button_text')->nullable()->after('promo_description');
            $table->string('promo_button_url')->nullable()->after('promo_button_text');
            $table->dateTime('promo_end_at')->nullable()->after('promo_button_url');
        });
    }

    public function down(): void
    {
        Schema::table('tour_packages', function (Blueprint $table) {
            $table->dropColumn([
                'group_offer_badge_text', 'group_offer_title', 'group_offer_description',
                'group_offer_button1_text', 'group_offer_button1_url', 'group_offer_image',
                'promo_badge_text', 'promo_title', 'promo_description',
                'promo_button_text', 'promo_button_url', 'promo_end_at',
            ]);
        });
    }
};