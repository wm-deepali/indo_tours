<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_pages', function (Blueprint $table) {
            $table->id();

            // ---- Banner ----
            $table->string('banner_image')->nullable();
            $table->string('banner_heading')->nullable();
            $table->text('banner_description')->nullable();

            // ---- Get in touch ----
            $table->string('touch_heading')->nullable();
            $table->text('touch_description')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            // ---- Opening hours repeater ----
            // Each entry: { "range": "October – March", "text": "Monday through Friday: 7 AM – 5 PM, PST" }
            $table->json('opening_hours')->nullable();

            // ---- Offices repeater ----
            // Each entry: { "heading": "Head Office", "address": "...", "map_url": "https://maps.google.com/...", "map_embed_url": "https://www.google.com/maps/embed?pb=..." }
            $table->json('offices')->nullable();

            // ---- FAQs section heading + repeater ----
            // Each entry: { "question": "...", "answer": "..." }
            $table->string('faqs_heading')->nullable();
            $table->json('faqs')->nullable();

            // ---- App promo / newsletter banner ----
            $table->string('promo_eyebrow')->nullable();
            $table->string('promo_heading')->nullable();
            $table->text('promo_description')->nullable();
            $table->string('promo_image')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_pages');
    }
};