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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->unique();  // Kode unik barang
            $table->string('nama_barang');
            $table->string('kategori');
            $table->integer('jumlah');
            $table->decimal('harga', 10, 2);
            $table->string('satuan');                   // Satuan barang, misal pcs, kg, liter
            $table->string('foto')->nullable();       // Nama file atau path foto, boleh kosong
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
