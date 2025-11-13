<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambahkan kolom role ke tabel users
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 🔹 Tambah kolom role setelah password
            $table->enum('role', ['admin', 'user'])->default('user')->after('password');
        });
    }

    /**
     * Hapus kolom role saat rollback
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
