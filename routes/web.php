<?php

use App\Http\Controllers\DynamicLinkController;
use App\Http\Controllers\MicrositePageController;
use App\Http\Controllers\StockLogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/link/{custom_slug}', [
    DynamicLinkController::class,
    'redirectToOriginalLink',
]);

Route::get('/qr-code/view/{id}', [
    DynamicLinkController::class,
    'viewQrCode',
])->name('qr.view');

Route::get('/qr-code/download/{id}', [
    DynamicLinkController::class,
    'downloadQrCode',
])->name('qr.download');

Route::get('/microsite/{slug}', [MicrositePageController::class, 'show'])->name(
    'microsite.show'
);

Route::get('/stock-log-report', [
    StockLogController::class,
    'generateReport',
])->name('stock-log.report');

// health check
Route::get('/health-check', function() {
    // Database check
    try {
        DB::connection()->getPdo();
    } catch (\Exception $e) {
        return response('DB connection failed', 500);
    }

    // Redis check
    try {
        Redis::ping();
    } catch (\Exception $e) {
        return response('Redis connection failed', 500);
    }

    return response('OK', 200);
});
