<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tambah foreign key `role_id`
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->nullable()->constrained('roles')->nullOnDelete();
        });

        // 2. Transfer data dari teks (role) menjadi relasi ID
        $users = DB::table('users')->get();
        foreach ($users as $user) {
            if ($user->role) {
                // Cari ID di tabel roles yang bersesuaian dengan slug lama
                $roleModel = DB::table('roles')->where('key', $user->role)->first();
                if ($roleModel) {
                    DB::table('users')->where('id', $user->id)->update([
                        'role_id' => $roleModel->id
                    ]);
                }
            }
        }

        // 3. Hapus kolom string lama
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->nullable();
        });

        $users = DB::table('users')->get();
        foreach ($users as $user) {
            if ($user->role_id) {
                $roleModel = DB::table('roles')->where('id', $user->role_id)->first();
                if ($roleModel) {
                    DB::table('users')->where('id', $user->id)->update([
                        'role' => $roleModel->key
                    ]);
                }
            }
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
};
