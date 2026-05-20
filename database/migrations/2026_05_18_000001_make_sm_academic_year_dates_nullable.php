<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeSmAcademicYearDatesNullable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sm_academic_years', function (Blueprint $table): void {
            $table->date('starting_date')->nullable()->change();
            $table->date('ending_date')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sm_academic_years', function (Blueprint $table): void {
            $table->date('starting_date')->nullable(false)->change();
            $table->date('ending_date')->nullable(false)->change();
        });
    }
}
