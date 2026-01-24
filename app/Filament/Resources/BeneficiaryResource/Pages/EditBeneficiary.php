<?php

namespace App\Filament\Resources\BeneficiaryResource\Pages;

use App\Filament\Resources\BeneficiaryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditBeneficiary extends EditRecord
{
    protected static string $resource = BeneficiaryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getTitle(): string|Htmlable
    {
        return __(key: 'Edit Data Penerima Manfaat');
    }
}
