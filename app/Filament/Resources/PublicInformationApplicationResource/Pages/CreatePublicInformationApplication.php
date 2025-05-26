<?php

namespace App\Filament\Resources\PublicInformationApplicationResource\Pages;

use App\Filament\Resources\PublicInformationApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreatePublicInformationApplication extends CreateRecord
{
    protected static string $resource = PublicInformationApplicationResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getTitle(): string|Htmlable
    {
        return __(key: 'Tambah Pemohon Informasi Publik');
    }
}
