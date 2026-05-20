<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSmBoardsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sm_boards', function (Blueprint $table): void {
            $table->increments('id');
            $table->string('name', 100);
            $table->tinyInteger('active_status')->default(1);
            $table->unsignedInteger('school_id')->nullable()->default(1);
            $table->timestamps();

            $table->unique(['school_id', 'name']);
            $table->foreign('school_id')->references('id')->on('sm_schools')->onDelete('cascade');
        });

        $settings = DB::table('sm_general_settings')->select('school_id', 'boards')->get();
        foreach ($settings as $setting) {
            $boards = [];
            if (!empty($setting->boards)) {
                $decoded = json_decode($setting->boards, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $boards = $decoded;
                } else {
                    $boards = preg_split('/[,\n]+/', (string) $setting->boards) ?: [];
                }
            }

            $boards = array_values(array_filter(array_map(static function ($board) {
                return trim((string) $board);
            }, $boards)));

            foreach ($boards as $board) {
                DB::table('sm_boards')->updateOrInsert([
                    'school_id' => $setting->school_id,
                    'name' => $board,
                ], [
                    'active_status' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sm_boards');
    }
}
