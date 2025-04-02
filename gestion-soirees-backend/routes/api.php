<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoireeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\GoodieController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Routes pour les soirées
Route::apiResource('soirees', SoireeController::class);

// Routes pour les réservations
Route::apiResource('reservations', ReservationController::class);

// Routes pour les goodies
Route::apiResource('goodies', GoodieController::class);
