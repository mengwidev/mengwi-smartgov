<?php

use App\Http\Controllers\DynamicLinkController;
use App\Http\Controllers\MicrositePageController;
use App\Http\Controllers\StockLogController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis as RedisFacade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

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
Route::get('/health-check', function () {
    try {
        DB::connection()->getPdo();
    } catch (\Exception $e) {
        return response('DB connection failed: ' . $e->getMessage(), 500);
    }

    return response('OK', 200);
});
