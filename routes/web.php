<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

// Public Route
Route::get('/', function () {
    return view('auth.login');
});

// Dashboard Route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Link Management Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/links', [LinkController::class, 'index'])->name('links.index');
    Route::post('/link', [LinkController::class, 'store'])->name('links.store');
    Route::get('/link/{custom_slug}', [LinkController::class, 'show'])->name('links.show');
    Route::get('/link/{id}/edit', [LinkController::class, 'edit'])->name('links.edit');
    Route::put('/link/{id}', [LinkController::class, 'update'])->name('links.update');
    Route::delete('/link/{id}', [LinkController::class, 'destroy'])->name('links.destroy');
    Route::get('/link/{id}/download', [LinkController::class, 'download'])->name('links.download');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include Auth Routes
require __DIR__.'/auth.php';
