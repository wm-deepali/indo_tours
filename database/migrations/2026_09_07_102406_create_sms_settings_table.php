<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sms_settings', function (Blueprint $table) {
            $table->id();

            // ── MSG91 ────────────────────────────────────────────────────────
            $table->text('msg91_auth_key')->nullable();
            $table->tinyInteger('msg91_route')->default(4)->comment('4 = Transactional, 1 = Promotional');
            $table->string('msg91_dlt_entity_id')->nullable();

            // ── Sender / Global ──────────────────────────────────────────────
            $table->string('sender_id')->nullable()->comment('DLT-registered sender name, max 11 chars');
            $table->string('default_country_code')->default('91');

            // ── Master switch ────────────────────────────────────────────────
            $table->boolean('enabled')->default(false);

            // ── Notification event toggles (inquiry-based) ──────────────────
            $table->boolean('notify_otp')->default(false);
            $table->boolean('notify_package_enquiry')->default(false);
            $table->boolean('notify_callback_request')->default(false);
            $table->boolean('notify_general_inquiry')->default(false);
            $table->boolean('notify_popup_inquiry')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sms_settings');
    }
};