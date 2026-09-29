<?php
// database/migrations/2026_09_29_000004_add_enquiry_ref_id_to_quick_enquiries_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('quick_enquiries', function (Blueprint $table) {
            $table->unsignedBigInteger('enquiry_ref_id')->nullable()->after('enquiry_for');
            $table->index(['enquiry_type', 'enquiry_ref_id']);
        });
    }

    public function down(): void
    {
        Schema::table('quick_enquiries', function (Blueprint $table) {
            $table->dropIndex(['enquiry_type', 'enquiry_ref_id']);
            $table->dropColumn('enquiry_ref_id');
        });
    }
};