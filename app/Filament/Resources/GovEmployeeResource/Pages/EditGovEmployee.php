<?php

namespace App\Filament\Resources\GovEmployeeResource\Pages;

use App\Filament\Resources\GovEmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGovEmployee extends EditRecord
{
    protected static string $resource = GovEmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    // Set the page title
    public function getTitle(): string
    {
        return 'Ubah Pegawai';
    }
}
