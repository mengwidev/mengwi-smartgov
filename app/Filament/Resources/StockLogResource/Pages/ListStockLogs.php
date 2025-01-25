<?php

namespace App\Filament\Resources\StockLogResource\Pages;

use App\Filament\Resources\StockLogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListStockLogs extends ListRecords
{
    protected static string $resource = StockLogResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }

    public function getTitle(): string|Htmlable
    {
        return __('Barang Masuk/Keluar');
    }
}
