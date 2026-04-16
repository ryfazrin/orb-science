<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->integer('time_limit_minutes')->nullable()->after('is_free_preview');
        });

        Schema::table('user_quiz_results', function (Blueprint $table) {
            $table->timestamp('started_at')->nullable()->after('passed');
            $table->integer('attempt_number')->default(1)->after('started_at');
        });
    }

    public function down(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropColumn('time_limit_minutes');
        });

        Schema::table('user_quiz_results', function (Blueprint $table) {
            $table->dropColumn(['started_at', 'attempt_number']);
        });
    }
};
