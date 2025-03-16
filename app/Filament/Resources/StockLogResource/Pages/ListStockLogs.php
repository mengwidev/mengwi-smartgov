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
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('downloadReport')
                ->label('Download PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->url(function () {
                    // Capture the tableFilters array from the query string
                    $filters = request()->query('tableFilters', []);

                    // Extract start_date and end_date from the tableFilters array
                    $startDate = $filters['date']['start_date'] ?? null;
                    $endDate = $filters['date']['end_date'] ?? null;

                    // Return the URL with the filters passed as query parameters
                    return route('stock-log.report', [
                        'start_date' => $startDate,
                        'end_date' => $endDate,
                    ]);
                }),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return __('Barang Masuk/Keluar');
    }
}
