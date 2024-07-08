<?php

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\DestinasiController;
use App\Http\Controllers\User\ExportController;
use App\Http\Controllers\User\PaketWisataController;
use App\Models\Destinasi;
use Illuminate\Support\Facades\Route;

Route::redirect('/','user/dashboard');
Route::get('dashboard', [DashboardController::class,'index'])->name('user.dashboard');
Route::get('welcome', [DashboardController::class,'welcome']);
Route::resource('destinasi', DestinasiController::class);
Route::put('destinasi/foto/{destinasi}',[DestinasiController::class, 'updateGambar']);
// Paket Wisata
Route::post('destinasi/tambahpaket/{destinasi}',[PaketWisataController::class, 'tambahpaket']);
Route::post('destinasi/tambahpaket',[PaketWisataController::class, 'tambahpaket2']);
Route::get('paket',[PaketWisataController::class, 'indexPaket'])->name('user.paket');
Route::get('filter-paket', [PaketWisataController::class, 'filter'])->name('user.paket.filter');
Route::delete('paket/{paket}',[PaketWisataController::class, 'hapusPaket']);
Route::get('paket/{paket}',[PaketWisataController::class, 'infoPaket']);
Route::get('paket/{paket}/1',[PaketWisataController::class, 'infoPaket1']);
Route::put('paket/foto/{paket}',[PaketWisataController::class, 'fotoPaket']);
Route::put('paket/data/{paket}',[PaketWisataController::class, 'dataPaket']);
Route::put('paket/level/{paket}',[PaketWisataController::class, 'levelPaket']);
Route::put('paket/kontak/{paket}',[PaketWisataController::class, 'kontakPaket']);
// Aktifitas
Route::post('paket/{paket}/aktifitas',[DestinasiController::class, 'tambahAktifitas']);
Route::put('paket/{paket}/aktifitas/{id}/edit', [DestinasiController::class, 'editAktifitas']);
// Fasilitas
Route::post('paket/{paket}/tambah-fasilitas', [DestinasiController::class, 'tambahFasilitas'])->name('paket.tambah-fasilitas');
Route::delete('paket/{id}/fasilitas', [DestinasiController::class, 'deleteallFasilitas']);
Route::get('fasilitas/{fasilitas}/delete',[DestinasiController::class,'deleteFasilitas']);
// Export
Route::get('export',[ExportController::class,'index']);
Route::get('export/destinasi/{destinasi}/export',[ExportController::class,'exportDestinasi']);
Route::get('export/destinasi/{destinasi}',[ExportController::class,'destinasi']);