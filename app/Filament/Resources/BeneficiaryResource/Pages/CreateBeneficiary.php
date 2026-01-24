<?php

namespace App\Filament\Resources\BeneficiaryResource\Pages;

use App\Filament\Resources\BeneficiaryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateBeneficiary extends CreateRecord
{
    protected static string $resource = BeneficiaryResource::class;

    public function getTitle(): string|Htmlable
    {
        return __(key: 'Tambah Penerima Manfaat');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
