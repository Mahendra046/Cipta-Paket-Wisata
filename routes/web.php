<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/','beranda');

//google Login
Route::get('/auth/redirect', [SocialController::class, 'redirect'])->name('google.redirect');
Route::get('/google/redirect', [SocialController::class, 'googleCallback'])->name('google.callback');
Route::get('/logout', [SocialController::class, 'logout'])->name('logout');
//login  laravel
Route::get('login', [AuthController::class, 'login']);
Route::post('login', [AuthController::class,'loginProcess'])->name('login');
// Route Admin
    Route::prefix('superuser')
        ->middleware('auth:admin')
        ->group(function () {
            include "_/admin.php";
        });
    Route::prefix('user')
        ->middleware('auth:user')
        ->group(function () {
            include "_/user.php";
        });
include "_/front.php";