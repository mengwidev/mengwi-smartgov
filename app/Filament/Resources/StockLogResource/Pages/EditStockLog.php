<?php

namespace App\Filament\Resources\StockLogResource\Pages;

use App\Filament\Resources\StockLogResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditStockLog extends EditRecord
{
    protected static string $resource = StockLogResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }

    public function getTitle(): string|Htmlable
    {
        return __('Ubah Barang Masuk/Keluar');
    }
}
