<?php

namespace App\Filament\Resources\InformationClassificationResource\Pages;

use App\Filament\Resources\InformationClassificationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateInformationClassification extends CreateRecord
{
    protected static string $resource = InformationClassificationResource::class;

    public function getTitle(): string|Htmlable
    {
        return __('Tambah Klasifikasi Informasi');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
