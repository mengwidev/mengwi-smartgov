<?php

use App\Http\Controllers\Api\MobileMenuController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DaftarPemohonInformasiPublikController;
use App\Http\Controllers\Api\ProfilPpidController;
use App\Http\Controllers\Api\PublicInformationController;
use App\Http\Resources\DaftarPemohonInformasiPublikResource;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);

// Public routes (GET requests)
Route::get('/mobilemenu', [MobileMenuController::class, 'index']);
Route::apiResource('/informasi-publik', PublicInformationController::class)->only(['index']);
Route::apiResource('/profil-ppid', ProfilPpidController::class)->only(['index']);
Route::apiResource('/daftar-pemohon', DaftarPemohonInformasiPublikController::class)->only(['index']);

// Protected routes (POST, PUT, PATCH, DELETE)
Route::middleware('auth:sanctum',)->group(function () {
    Route::post('/mobilemenu', [MobileMenuController::class, 'store']);
    Route::put('/mobilemenu/{id}', [MobileMenuController::class, 'update']);
    Route::patch('/mobilemenu/{id}', [MobileMenuController::class, 'update']);
    Route::delete('/mobilemenu/{id}', [MobileMenuController::class, 'destroy']);
});
