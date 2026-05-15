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
        if (Schema::hasTable('sm_general_settings') && ! Schema::hasColumn('sm_general_settings', 'boards')) {
            Schema::table('sm_general_settings', function (Blueprint $table): void {
                $table->text('boards')->nullable()->after('role_based_sidebar');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('sm_general_settings') && Schema::hasColumn('sm_general_settings', 'boards')) {
            Schema::table('sm_general_settings', function (Blueprint $table): void {
                $table->dropColumn('boards');
            });
        }
    }
};
