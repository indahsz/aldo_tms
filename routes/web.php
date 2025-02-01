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

Route::resource('bongkar', BongkarController::class);
