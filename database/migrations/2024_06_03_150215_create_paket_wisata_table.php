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
        Schema::create('paket_wisata', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->char('id_user', 36);
            $table->char('id_destinasi', 36);
            $table->string('nama_paket_wisata');
            $table->longText('deskripsi')->nullable();
            $table->string('durasi')->nullable();
            $table->integer('jumlah_peserta')->nullable();
            $table->string('nama_penyelenggara')->nullable();
            $table->string('kontak_penyelenggara')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_destinasi')->references('id')->on('destinasi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_wisata');
    }
};
