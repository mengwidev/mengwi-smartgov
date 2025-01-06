<?php

namespace App\Filament\Imports;

use App\Models\GovEmployee;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class GovEmployeeImporter extends Importer
{
    protected static ?string $model = GovEmployee::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('att_pin')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('date_of_birth')
                ->requiredMapping()
                ->rules(['required', 'date']),
            ImportColumn::make('prefix_title')
                ->rules(['max:255']),
            ImportColumn::make('suffix_title')
                ->rules(['max:255']),
            ImportColumn::make('lastEducation')
                ->requiredMapping()
                ->relationship()
                ->rules(['required']),
            ImportColumn::make('banjar')
                ->requiredMapping()
                ->relationship()
                ->rules(['required']),
            ImportColumn::make('employmentPosition')
                ->requiredMapping()
                ->relationship()
                ->rules(['required']),
        ];
    }

    public function resolveRecord(): ?GovEmployee
    {
        // return GovEmployee::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new GovEmployee();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your gov employee import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
