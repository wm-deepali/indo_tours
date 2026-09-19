<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tour_packages', function (Blueprint $table) {
            $table->unsignedSmallInteger('duration_days')->nullable()->after('duration_text')->index();
            $table->unsignedSmallInteger('duration_nights')->nullable()->after('duration_days');
        });

        // Backfill existing packages from text like "6D / 5N", "7 Days" or "6 Days 5 Nights".
        // Rows whose text can't be read stay empty and get filled when the package is edited.
        DB::table('tour_packages')
            ->whereNotNull('duration_text')
            ->chunkById(100, function ($rows) {
                foreach ($rows as $row) {
                    if (!preg_match('/(\d+)\s*D/i', $row->duration_text, $d)) {
                        continue;
                    }

                    $days = (int) $d[1];
                    $nights = preg_match('/(\d+)\s*N/i', $row->duration_text, $n)
                        ? (int) $n[1]
                        : max($days - 1, 0);

                    DB::table('tour_packages')
                        ->where('id', $row->id)
                        ->update([
                            'duration_days'   => $days,
                            'duration_nights' => $nights,
                        ]);
                }
            });
    }

    public function down(): void
    {
        Schema::table('tour_packages', function (Blueprint $table) {
            $table->dropColumn(['duration_days', 'duration_nights']);
        });
    }
};