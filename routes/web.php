<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('main');
// });

use App\Http\Controllers\MainController;
use App\Http\Controllers\AngkutController;
use App\Http\Controllers\BongkarController;

Route::get('/', [MainController::class, 'index']);

Route::resource('angkut', AngkutController::class);
Route::post('/angkut/uploadSim/{id}', [AngkutController::class, 'uploadSim'])->name('angkut.uploadSim');
Route::post('/angkut/uploadStnk/{id}', [AngkutController::class, 'uploadStnk'])->name('angkut.uploadStnk');
Route::post('/angkut/uploadDokumen/{id}', [AngkutController::class, 'uploadDokumen'])->name('angkut.uploadDokumen');



Route::resource('bongkar', BongkarController::class);
