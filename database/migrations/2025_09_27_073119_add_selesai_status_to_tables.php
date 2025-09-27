<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Mengubah kolom status di tabel barang_hilangs
        Schema::table('barang_hilangs', function (Blueprint $table) {
            $table->enum('status', ['menunggu', 'diterima', 'ditolak', 'selesai'])->default('menunggu')->change();
        });

        // Mengubah kolom status di tabel barang_temuans
        Schema::table('barang_temuans', function (Blueprint $table) {
            $table->enum('status', ['menunggu', 'diterima', 'ditolak', 'selesai'])->default('menunggu')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Logika untuk mengembalikan jika diperlukan (rollback)
        Schema::table('barang_hilangs', function (Blueprint $table) {
            $table->enum('status', ['menunggu', 'diterima', 'ditolak'])->default('menunggu')->change();
        });

        Schema::table('barang_temuans', function (Blueprint $table) {
            $table->enum('status', ['menunggu', 'diterima', 'ditolak'])->default('menunggu')->change();
        });
    }
};
