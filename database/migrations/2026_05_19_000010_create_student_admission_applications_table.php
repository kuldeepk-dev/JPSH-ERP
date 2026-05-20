<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_admission_applications', function (Blueprint $table) {
            $table->id();
            $table->string('application_id', 50)->nullable()->index();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->unsignedBigInteger('student_id')->nullable()->index();
            $table->unsignedBigInteger('school_id')->nullable()->index();
            $table->unsignedBigInteger('academic_id')->nullable()->index();
            $table->string('status', 30)->default('draft')->index();
            $table->longText('data_json')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_admission_applications');
    }
};
