<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DynamicLinkController;
use App\Http\Controllers\MicrositePageController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/link/{custom_slug}', [DynamicLinkController::class, 'redirectToOriginalLink']);
Route::get('/qr-code/view/{id}', [DynamicLinkController::class, 'viewQrCode'])->name('qr.view');
Route::get('/qr-code/download/{id}', [DynamicLinkController::class, 'downloadQrCode'])->name('qr.download');

Route::get('/microsite/{slug}', [MicrositePageController::class, 'show'])->name('microsite.show');
