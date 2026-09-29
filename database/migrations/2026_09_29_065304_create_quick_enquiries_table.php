<?php
// database/migrations/2026_09_29_000003_create_quick_enquiries_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('quick_enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email');
            $table->string('country_code', 10)->default('+91');
            $table->string('phone', 20);
            $table->string('travel_dates')->nullable();
            $table->unsignedSmallInteger('traveller_count')->nullable();
            $table->text('message')->nullable();
            $table->string('enquiry_type')->nullable();
            $table->string('enquiry_for')->nullable();
            $table->string('source_url', 500)->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('status')->default('new'); // new | contacted | closed
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quick_enquiries');
    }
};