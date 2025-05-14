<?php

namespace App\Filament\Resources\PublicInformationResource\Pages;

use App\Filament\Resources\PublicInformationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListPublicInformation extends ListRecords
{
    protected static string $resource = PublicInformationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return __(key: 'Informasi Publik');
    }
}
