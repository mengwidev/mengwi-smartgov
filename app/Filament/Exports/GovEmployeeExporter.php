<?php

namespace App\Filament\Exports;

use App\Models\GovEmployee;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class GovEmployeeExporter extends Exporter
{
    protected static ?string $model = GovEmployee::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('att_pin'),
            ExportColumn::make('name'),
            ExportColumn::make('date_of_birth'),
            ExportColumn::make('prefix_title'),
            ExportColumn::make('suffix_title'),
            ExportColumn::make('lastEducation.name'),
            ExportColumn::make('banjar.id'),
            ExportColumn::make('employmentPosition.id'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your gov employee export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
