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
        Schema::create('barang_temuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_barang');
            $table->text('deskripsi_barang');
            $table->date('tgl_penemuan');
            $table->string('lokasi_penemuan');
            $table->string('gambar')->nullable();
            $table->enum('status', ['menunggu', 'diterima', 'ditolak'])->default('menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_temuans');
    }
};
