<?php

namespace App\Filament\Resources\GovEmployeeResource\Pages;

use App\Filament\Resources\GovEmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGovEmployees extends ListRecords
{
    protected static string $resource = GovEmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    // Set the page title
    public function getTitle(): string
    {
        return 'Daftar Pegawai';
    }
}
