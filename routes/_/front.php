<?php

use App\Http\Controllers\Front\BerandaController;
use App\Http\Controllers\Front\PaketWisataController;
use App\Http\Controllers\Front\ProfilController;
use App\Http\Controllers\Front\RencanaPerjalananController;
use App\Http\Controllers\Front\TentangKamiController;
use App\Http\Controllers\Front\User\DestinasiController;
use Illuminate\Support\Facades\Route;

Route::get('beranda', [BerandaController::class, 'index']);
Route::get('tentang-kami', [TentangKamiController::class, 'index']);
// Destinasi
Route::get('paket-destinasi',[PaketWisataController::class,'destinasiForm'])->name('paket.formDestinasi');
Route::post('paket-destinasi',[PaketWisataController::class,'destinasiCreate'])->name('paket.createDestinasi');
// Paket Wisata
Route::get('paket-wisata/{destinasi_id}', [PaketWisataController::class, 'createPaketWisata'])->name('paket.createPaketWisata');
Route::post('paket-wisata/{destinasi_id}', [PaketWisataController::class, 'storePaketWisata'])->name('paket.storePaketWisata');
// Aktivitas
Route::get('paket-aktivitas/{paket_wisata_id}', [PaketWisataController::class, 'createAktivitas'])->name('paket.createAktivitas');
Route::post('paket-aktivitas/{paket_wisata_id}', [PaketWisataController::class, 'storeAktivitas'])->name('paket.storeAktivitas');
// Routing untuk menampilkan form input fasilitas setelah aktivitas disimpan
Route::get('paket-fasilitas/{paket_wisata_id}', [PaketWisataController::class, 'createFasilitas'])->name('paket.createFasilitas');
Route::post('paket-fasilitas/{paket_wisata_id}', [PaketWisataController::class, 'storeFasilitas'])->name('paket.storeFasilitas');
// Export
Route::get('paket-export/{paket_wisata_id}', [PaketWisataController::class, 'exportPaket'])->name('paket.exportPaket');




Route::get('paket-detail/{id}', [PaketWisataController::class, 'showPaket'])->name('show.paket');
// Route::post('paket-wisata/{paket}/aktifitas', [PaketWisataController::class, 'aktifitas']);
// Route::put('paket-wisata/{paket}/aktifitas/{aktifitas}/edit', [PaketWisataController::class, 'Editaktifitas']);
// Route::post('paket-wisata/{paket}/fasilitas', [PaketWisataController::class, 'fasilitas']);
// Route::put('paket-wisata/upload-foto/{paket}', [PaketWisataController::class, 'fotoPaket']);
// Route::get('rencana-perjalanan', [RencanaPerjalananController::class, 'index']);
Route::resource('profil', ProfilController::class);
Route::middleware('auth:user')
    ->group(function () {
    });
