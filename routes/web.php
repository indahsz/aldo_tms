<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('main');
// });

use App\Http\Controllers\MainController;

Route::get('/', [MainController::class, 'index']);
