<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProfileController::class, 'index']);
Route::post('/profiles', [ProfileController::class, 'store']);
Route::post('/profiles/clear', [ProfileController::class, 'clear']);