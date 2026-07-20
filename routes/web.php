<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChirpController;

Route::get('/', [ChirpController::class, 'index']);
// Form gönderildiğinde bu route'a POST isteği gider
Route::post('/chirps', [ChirpController::class, 'store']);
