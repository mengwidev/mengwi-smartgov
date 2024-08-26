<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;

Route::get('/', [LinkController::class, 'index'])->name('links.index');
Route::post('/link', [LinkController::class, 'store'])->name('links.store');
Route::get('/link/{custom_slug}', [LinkController::class, 'show'])->name('links.show');
Route::get('/link/{id}/edit', [LinkController::class, 'edit'])->name('links.edit');
Route::put('/link/{id}', [LinkController::class, 'update'])->name('links.update');
Route::delete('/link/{id}', [LinkController::class, 'destroy'])->name('links.destroy');
Route::get('/link/{id}/download', [LinkController::class, 'download'])->name('links.download');
