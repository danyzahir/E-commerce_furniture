<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            // Tambahkan kolom category_id dan relasinya
            $table->foreignId('category_id')
                  ->nullable() // sementara boleh null biar data lama gak error
                  ->after('id')
                  ->constrained('categories')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
