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
        if (Schema::hasTable('sm_classes') && ! Schema::hasColumn('sm_classes', 'board_name')) {
            Schema::table('sm_classes', function (Blueprint $table): void {
                $table->string('board_name', 100)->nullable()->after('pass_mark');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('sm_classes') && Schema::hasColumn('sm_classes', 'board_name')) {
            Schema::table('sm_classes', function (Blueprint $table): void {
                $table->dropColumn('board_name');
            });
        }
    }
};
