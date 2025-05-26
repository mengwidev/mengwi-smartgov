<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MobileMenuController;
use App\Http\Controllers\Api\PagePpidController;
use App\Http\Controllers\Api\ProfilPpidController;
use App\Http\Controllers\Api\PublicInformationController;
use App\Http\Controllers\Api\DaftarPemohonInformasiPublikController;

// ---------------------------------------------
// 🔐 Authentication Routes
// ---------------------------------------------
Route::middleware('throttle:60,1')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
});

// Logout must be authenticated
Route::middleware(['auth:sanctum', 'throttle:60,1'])->post('logout', [AuthController::class, 'logout']);


// ---------------------------------------------
// 🌐 Public API Routes (GET-only)
// ---------------------------------------------
Route::middleware('throttle:60,1')->group(function () {
    Route::get('mobilemenu', [MobileMenuController::class, 'index']);

    Route::prefix('ppid')->group(function () {
        // Resource index endpoints
        Route::apiResource('profil', ProfilPpidController::class)->only('index');
        Route::apiResource('pages', PagePpidController::class)->only('index');
        Route::apiResource('informasi-publik', PublicInformationController::class)->only('index');
        Route::apiResource('daftar-pemohon', DaftarPemohonInformasiPublikController::class)->only('index');

        // Custom detail routes using slug
        Route::get('page/{slug}', [PagePpidController::class, 'show']);
        Route::get('informasi-publik/{slug}', [PublicInformationController::class, 'show']);
    });
});


// ---------------------------------------------
// 🔒 Authenticated & Protected Routes (Write Ops)
// ---------------------------------------------
Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {
    Route::post('mobilemenu', [MobileMenuController::class, 'store']);
    Route::put('mobilemenu/{id}', [MobileMenuController::class, 'update']);
    Route::patch('mobilemenu/{id}', [MobileMenuController::class, 'update']);
    Route::delete('mobilemenu/{id}', [MobileMenuController::class, 'destroy']);
});
