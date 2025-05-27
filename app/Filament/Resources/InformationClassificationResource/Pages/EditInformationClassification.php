<?php

namespace App\Filament\Resources\InformationClassificationResource\Pages;

use App\Filament\Resources\InformationClassificationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditInformationClassification extends EditRecord
{
    protected static string $resource = InformationClassificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return __('Edit Klasifikasi Informasi');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
