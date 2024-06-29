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
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nasabah_id');
            $table->varchar('pendapatan',50); // Huruf kecil dan menggunakan underscore
            $table->integer('jumlah_tanggungan'); // Huruf kecil dan menggunakan underscore
            $table->string('jaminan'); // Huruf kecil dan menggunakan underscore
            $table->varchar('jumlah_pinjaman', 50); // Huruf kecil dan menggunakan underscore
            $table->integer('lama_angsuran'); // Huruf kecil dan menggunakan underscore
            // Tambahkan kolom-kolom lainnya sesuai kebutuhan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};
