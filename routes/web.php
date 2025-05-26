<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DynamicLinkController;
use App\Http\Controllers\MicrositePageController;
use App\Http\Controllers\StockLogController;
use App\Http\Controllers\EmployeeController;
use App\Livewire\PublicInformationApplicationForm;
use App\Livewire\PublicInformationApplicationSuccess;
use App\Livewire\PublicInformationLookup;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home
Route::view('/', 'welcome')->name('home');


// Dynamic Links & QR Code
Route::prefix('link')->group(function () {
    Route::get('/{custom_slug}', [DynamicLinkController::class, 'redirectToOriginalLink'])->name('link.redirect');
});

Route::prefix('qr-code')->group(function () {
    Route::get('/view/{id}', [DynamicLinkController::class, 'viewQrCode'])->name('qr.view');
    Route::get('/download/{id}', [DynamicLinkController::class, 'downloadQrCode'])->name('qr.download');
});


// Microsite
Route::get('/microsite/{slug}', [MicrositePageController::class, 'show'])->name('microsite.show');


// Stock Log Report
Route::get('/stock-log-report', [StockLogController::class, 'generateReport'])->name('stock-log.report');


// Health Check (simple DB connectivity test)
Route::get('/health-check', function () {
    try {
        DB::connection()->getPdo();
        return response('OK', 200);
    } catch (\Exception $e) {
        return response('DB connection failed: ' . $e->getMessage(), 500);
    }
})->name('health.check');


// Employee Detail
Route::get('/employee/{employee}', [EmployeeController::class, 'show'])->name('employee.show');


// PPID Public Information Application Routes (Livewire)
Route::prefix('ppid')->group(function () {
    Route::get('permohonan-informasi', PublicInformationApplicationForm::class)->name('applications.create');

    Route::get(
        'permohonan-informasi/sukses/{public_information_application:uuid}',
        PublicInformationApplicationSuccess::class
    )->name('applications.success');

    Route::get('track', PublicInformationLookup::class)->name('ppid.track');
});
