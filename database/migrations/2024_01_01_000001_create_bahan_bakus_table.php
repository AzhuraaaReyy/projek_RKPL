<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bahan_bakus', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Nama bahan baku, contoh: Tepung Terigu
            $table->string('kategori'); // kering, cair, beku
            $table->integer('stok'); // Stok saat ini
            $table->enum('satuan', ['kg', 'gram', 'liter']); // satuan: gram, liter, pack
            $table->integer('minimum_stok'); // Batas minimum
            $table->date('tanggal_masuk'); // Tanggal bahan masuk
            $table->date('tanggal_kedaluwarsa'); // Tanggal kadaluarsa bahan
            $table->decimal('harga', 10, 2)->default(0); // harga satuan (opsional)
            $table->text('deskripsi');
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bahan_bakus');
    }
};
