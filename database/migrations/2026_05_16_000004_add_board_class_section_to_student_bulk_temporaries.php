<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('student_bulk_temporaries')) {
            Schema::table('student_bulk_temporaries', function (Blueprint $table): void {
                if (!Schema::hasColumn('student_bulk_temporaries', 'board_name')) {
                    $table->string('board_name', 100)->nullable()->after('admission_date');
                }
                if (!Schema::hasColumn('student_bulk_temporaries', 'class_name')) {
                    $table->string('class_name', 191)->nullable()->after('board_name');
                }
                if (!Schema::hasColumn('student_bulk_temporaries', 'section_name')) {
                    $table->string('section_name', 191)->nullable()->after('class_name');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('student_bulk_temporaries')) {
            Schema::table('student_bulk_temporaries', function (Blueprint $table): void {
                if (Schema::hasColumn('student_bulk_temporaries', 'section_name')) {
                    $table->dropColumn('section_name');
                }
                if (Schema::hasColumn('student_bulk_temporaries', 'class_name')) {
                    $table->dropColumn('class_name');
                }
                if (Schema::hasColumn('student_bulk_temporaries', 'board_name')) {
                    $table->dropColumn('board_name');
                }
            });
        }
    }
};

