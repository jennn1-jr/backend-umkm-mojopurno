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
        Schema::create('umkms', function (Blueprint $table) {
            $table->id();
            $table->string('nama_usaha', 255);
            $table->string('nama_pemilik', 255);
            $table->enum('kategori', ['Makanan', 'Kerajinan', 'Jasa', 'Pertanian', 'Ternak', 'Lainnya']);
            $table->text('deskripsi_usaha');
            $table->text('tentang_usaha')->nullable();
            $table->string('alamat', 500);
            $table->string('lokasi', 255);
            $table->string('nomor_wa', 20);
            $table->string('foto_sampul', 500)->nullable();
            $table->string('link_shopee', 500)->nullable();
            $table->string('link_tokopedia', 500)->nullable();
            $table->string('link_instagram', 500)->nullable();
            $table->string('link_facebook', 500)->nullable();
            $table->string('link_gmaps', 500)->nullable();
            $table->enum('status', ['pending', 'published', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};
