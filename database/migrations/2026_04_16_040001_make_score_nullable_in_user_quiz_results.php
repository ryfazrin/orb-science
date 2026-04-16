<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_quiz_results', function (Blueprint $table) {
            // Score null = attempt sedang berjalan (belum di-submit)
            // Score 0-100 = sudah di-submit
            $table->integer('score')->nullable()->default(null)->change();
        });
    }

    public function down(): void
    {
        Schema::table('user_quiz_results', function (Blueprint $table) {
            $table->integer('score')->default(0)->change();
        });
    }
};
