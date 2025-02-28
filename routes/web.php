<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AngkutController;
use App\Http\Controllers\LaporanAngkutController;
use App\Http\Controllers\BongkarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

    // Default route (redirected to after login)
    Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


// Profile management routes (require authentication)
Route::middleware('auth')->group(function () {

    // Resource routes for 'angkut'
    Route::resource('angkut', AngkutController::class);
    Route::post('/angkut/uploadSim/{id}', [AngkutController::class, 'uploadSim'])->name('angkut.uploadSim');
    Route::post('/angkut/uploadStnk/{id}', [AngkutController::class, 'uploadStnk'])->name('angkut.uploadStnk');
    Route::post('/angkut/uploadDokumen/{id}', [AngkutController::class, 'uploadDokumen'])->name('angkut.uploadDokumen');
    Route::post('/angkut/muatStart/{id}', [AngkutController::class, 'muatStart'])->name('angkut.muatStart');
    Route::post('/angkut/muatDone/{id}', [AngkutController::class, 'muatDone'])->name('angkut.muatDone');

    // Resource routes for 'bongkar'
    Route::resource('bongkar', BongkarController::class);
    Route::post('/bongkar/uploadSim/{id}', [BongkarController::class, 'uploadSim'])->name('bongkar.uploadSim');
    Route::post('/bongkar/uploadStnk/{id}', [BongkarController::class, 'uploadStnk'])->name('bongkar.uploadStnk');
    Route::post('/bongkar/uploadDokumen/{id}', [BongkarController::class, 'uploadDokumen'])->name('bongkar.uploadDokumen');

    //Resource route for 'Laporan'
    Route::resource('laporanAngkut', LaporanAngkutController::class);


});

// Laravel Breeze authentication routes
require __DIR__ . '/auth.php';
