<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoireeController;
use App\Http\Controllers\GoodieController;
use App\Http\Controllers\ReservationController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->group(function () {
    // Routes pour les soirées
    Route::get('/soirees', [SoireeController::class, 'index']);
    Route::get('/soirees/{id}', [SoireeController::class, 'show']);
    Route::post('/soirees', [SoireeController::class, 'store']);
    Route::put('/soirees/{id}', [SoireeController::class, 'update']);
    Route::delete('/soirees/{id}', [SoireeController::class, 'destroy']);

    // Routes pour les goodies
    Route::get('/goodies', [GoodieController::class, 'index']);
    Route::get('/goodies/{id}', [GoodieController::class, 'show']);
    Route::post('/goodies', [GoodieController::class, 'store']);
    Route::put('/goodies/{id}', [GoodieController::class, 'update']);
    Route::delete('/goodies/{id}', [GoodieController::class, 'destroy']);

    // Routes pour les réservations
    Route::get('/reservations', [ReservationController::class, 'index']);
    Route::get('/reservations/{id}', [ReservationController::class, 'show']);
    Route::post('/reservations', [ReservationController::class, 'store']);
    Route::put('/reservations/{id}', [ReservationController::class, 'update']);
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy']);
    Route::put('/reservations/{id}/status', [ReservationController::class, 'updateStatus']);
});
