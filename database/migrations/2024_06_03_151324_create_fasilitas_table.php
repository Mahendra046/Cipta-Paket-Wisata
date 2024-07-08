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
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->char('id_paket_wisata', 36);
            $table->string('nama_fasilitas')->nullable();
            $table->longText('deskripsi_fasilitas')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('satuan')->nullable();
            $table->string('harga_satuan');
            $table->timestamps();

            $table->foreign('id_paket_wisata')
                ->references('id')
                ->on('paket_wisata')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cpw__fasilitas');
    }
};
