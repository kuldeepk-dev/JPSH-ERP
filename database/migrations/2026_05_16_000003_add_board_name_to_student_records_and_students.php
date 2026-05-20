<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('sm_students') && !Schema::hasColumn('sm_students', 'board_name')) {
            Schema::table('sm_students', function (Blueprint $table): void {
                $table->string('board_name', 100)->nullable()->after('admission_date');
            });
        }

        if (Schema::hasTable('student_records') && !Schema::hasColumn('student_records', 'board_name')) {
            Schema::table('student_records', function (Blueprint $table): void {
                $table->string('board_name', 100)->nullable()->after('section_id');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('sm_students') && Schema::hasColumn('sm_students', 'board_name')) {
            Schema::table('sm_students', function (Blueprint $table): void {
                $table->dropColumn('board_name');
            });
        }

        if (Schema::hasTable('student_records') && Schema::hasColumn('student_records', 'board_name')) {
            Schema::table('student_records', function (Blueprint $table): void {
                $table->dropColumn('board_name');
            });
        }
    }
};

