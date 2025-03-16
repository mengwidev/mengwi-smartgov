<?php

namespace App\Filament\Imports;

use App\Models\Attendance;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class AttendanceImporter extends Importer
{
    protected static ?string $model = Attendance::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('att_helper_identification')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('employee')
                ->requiredMapping()
                ->relationship()
                ->rules(['required']),
            ImportColumn::make('scan_date')
                ->requiredMapping()
                ->rules(['required', 'datetime']),
            ImportColumn::make('month')
                ->requiredMapping()
                ->relationship()
                ->rules(['required']),
            ImportColumn::make('attType')
                ->requiredMapping()
                ->relationship()
                ->rules(['required']),
        ];
    }

    public function resolveRecord(): ?Attendance
    {
        // return Attendance::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Attendance;
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your attendance import has completed and '.number_format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}
