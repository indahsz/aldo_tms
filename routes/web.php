<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AngkutController;
use App\Http\Controllers\BongkarController;
use Illuminate\Support\Facades\Route;

// Default route (redirected to after login)
Route::get('/', [MainController::class, 'index'])->middleware(['auth', 'verified'])->name('home');

// Profile management routes (require authentication)
Route::middleware('auth')->group(function () {
    // Resource routes for 'angkut'
    Route::resource('angkut', AngkutController::class);
    Route::post('/angkut/uploadSim/{id}', [AngkutController::class, 'uploadSim'])->name('angkut.uploadSim');
    Route::post('/angkut/uploadStnk/{id}', [AngkutController::class, 'uploadStnk'])->name('angkut.uploadStnk');
    Route::post('/angkut/uploadDokumen/{id}', [AngkutController::class, 'uploadDokumen'])->name('angkut.uploadDokumen');

    // Resource routes for 'bongkar'
    Route::resource('bongkar', BongkarController::class);
});

// Laravel Breeze authentication routes
require __DIR__.'/auth.php';
