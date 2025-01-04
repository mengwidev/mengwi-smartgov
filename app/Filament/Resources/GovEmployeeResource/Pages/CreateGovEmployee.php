<?php

namespace App\Filament\Resources\GovEmployeeResource\Pages;

use App\Filament\Resources\GovEmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGovEmployee extends CreateRecord
{
    protected static string $resource = GovEmployeeResource::class;

    // Set the page title
    public function getTitle(): string
    {
        return 'Tambah Pegawai';
    }
}
