<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\KaderBankSampahController;
use App\Models\KaderBankSampah;
use Illuminate\Support\Facades\Route;

// Public Route
Route::get('/', function () {
    return view('welcome');
});

// Dashboard Route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Link Management Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/links', [LinkController::class, 'index'])->name('links.index');
    Route::post('/link', [LinkController::class, 'store'])->name('links.store');
    Route::get('/link/{id}/edit', [LinkController::class, 'edit'])->name('links.edit');
    Route::put('/link/{id}', [LinkController::class, 'update'])->name('links.update');
    Route::delete('/link/{id}', [LinkController::class, 'destroy'])->name('links.destroy');
    Route::get('/link/{id}/download', [LinkController::class, 'download'])->name('links.download');
  });
  
Route::get('/link/{custom_slug}', [LinkController::class, 'show'])->name('links.show');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Kader Bank Sampah Controller
Route::middleware(['role:admin'])->group(function () {
    Route::get('/bank_sampah/kader', [KaderBankSampahController::class, 'index'])->name('bank_sampah.kader.index');
    Route::post('/bank_sampah/kader', [KaderBankSampahController::class, 'store'])->name('bank_sampah.kader.store');
    Route::get('/bank_sampah/kader/{id}/edit', [KaderBankSampahController::class, 'edit'])->name('bank_sampah.kader.edit');
    Route::put('/bank_sampah/kader/{id}', [KaderBankSampahController::class, 'update'])->name('bank_sampah.kader.update');
    Route::delete('bank_sampah/kader/{id}', [KaderBankSampahController::class, 'destroy'])->name('bank_sampah.kader.destroy');
    // PRINT ROUTE
    Route::get('/bank_sampah/kader/print/list', [KaderBankSampahController::class, 'printList'])->name('bank_sampah.kader.print.list');
    Route::get('/bank_sampah/kader/print/wage', [KaderBankSampahController::class, 'printWage'])->name('bank_sampah.kader.print.wage');
});

// Include Auth Routes
require __DIR__.'/auth.php';
