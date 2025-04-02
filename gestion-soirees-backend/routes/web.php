<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoireeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\GoodieController;

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

Route::get('/', function () {
    return view('welcome');
});

// Routes pour les soirées
Route::get('/soirees', [SoireeController::class, 'index'])->name('soirees.index');
Route::get('/soirees/create', [SoireeController::class, 'create'])->name('soirees.create');
Route::post('/soirees', [SoireeController::class, 'store'])->name('soirees.store');
Route::get('/soirees/{id}', [SoireeController::class, 'show'])->name('soirees.show');
Route::get('/soirees/{id}/edit', [SoireeController::class, 'edit'])->name('soirees.edit');
Route::put('/soirees/{id}', [SoireeController::class, 'update'])->name('soirees.update');
Route::delete('/soirees/{id}', [SoireeController::class, 'destroy'])->name('soirees.destroy');

// Routes pour les réservations
Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/reservations/{id}', [ReservationController::class, 'show'])->name('reservations.show');
Route::get('/reservations/{id}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
Route::put('/reservations/{id}', [ReservationController::class, 'update'])->name('reservations.update');
Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

// Routes pour les goodies
Route::get('/goodies', [GoodieController::class, 'index'])->name('goodies.index');
Route::get('/goodies/create', [GoodieController::class, 'create'])->name('goodies.create');
Route::post('/goodies', [GoodieController::class, 'store'])->name('goodies.store');
Route::get('/goodies/{id}', [GoodieController::class, 'show'])->name('goodies.show');
Route::get('/goodies/{id}/edit', [GoodieController::class, 'edit'])->name('goodies.edit');
Route::put('/goodies/{id}', [GoodieController::class, 'update'])->name('goodies.update');
Route::delete('/goodies/{id}', [GoodieController::class, 'destroy'])->name('goodies.destroy');
