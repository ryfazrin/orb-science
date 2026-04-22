<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_access_settings', function (Blueprint $table) {
            $table->id();
            $table->string('resource_key');          // e.g. App\Filament\Resources\CourseResource
            $table->enum('role', ['student', 'instructor', 'admin'])->default('instructor');
            $table->boolean('is_visible')->default(true);
            $table->timestamps();

            $table->unique(['resource_key', 'role']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_access_settings');
    }
};
