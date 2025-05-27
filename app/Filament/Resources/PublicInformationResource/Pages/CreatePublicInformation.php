<?php

namespace App\Filament\Resources\PublicInformationResource\Pages;

use App\Filament\Resources\PublicInformationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreatePublicInformation extends CreateRecord
{
    protected static string $resource = PublicInformationResource::class;

    public function getTitle(): string|Htmlable
    {
        return __(key: 'Tambah Informasi Publik');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
