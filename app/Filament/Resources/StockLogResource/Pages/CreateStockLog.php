<?php

namespace App\Filament\Resources\StockLogResource\Pages;

use App\Filament\Resources\StockLogResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateStockLog extends CreateRecord
{
    protected static string $resource = StockLogResource::class;

    public function getTitle(): string|Htmlable
    {
        return __('Input Barang Masuk/Keluar');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
