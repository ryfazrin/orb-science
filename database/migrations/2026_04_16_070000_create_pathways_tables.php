<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pathways', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('icon')->nullable()->default('map');
            $table->string('color')->nullable()->default('#6c63ff');
            $table->timestamps();
        });

        Schema::create('pathway_levels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pathway_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('pathway_level_course', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pathway_level_id')->constrained('pathway_levels')->cascadeOnDelete();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->integer('order')->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pathway_level_course');
        Schema::dropIfExists('pathway_levels');
        Schema::dropIfExists('pathways');
    }
};
