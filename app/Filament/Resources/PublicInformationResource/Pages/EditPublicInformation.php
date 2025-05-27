<?php

namespace App\Filament\Resources\PublicInformationResource\Pages;

use App\Filament\Resources\PublicInformationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditPublicInformation extends EditRecord
{
    protected static string $resource = PublicInformationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return __(key: 'Edit Informasi Publik');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
