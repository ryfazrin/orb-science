<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah enum(student, instructor, admin) tipe enum menjadi tipe string standar
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('student')->change();
        });
    }

    public function down(): void
    {
        // Secara teknis rollback dari string ke enum spesifik memiliki resiko kehilangan data,
        // Tapi kita bisa sediakan struktur kasarnya.
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['student', 'instructor', 'admin'])->default('student')->change();
        });
    }
};
