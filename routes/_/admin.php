<?php

use App\Http\Controllers\Admin\MasterData\AdminController;
use App\Http\Controllers\Admin\MasterData\UserController;
use App\Http\Controllers\Admin\PaketWisataController;
use Illuminate\Support\Facades\Route;

Route::redirect('/','superuser/master-data/user')->name('superuser.user');
Route::resource('master-data/user', UserController::class);
Route::resource('master-data/admin', AdminController::class);
Route::resource('paket-wisata', PaketWisataController::class);