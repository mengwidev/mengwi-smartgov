<?php

namespace App\Filament\Resources\InformationClassificationResource\Pages;

use App\Filament\Resources\InformationClassificationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListInformationClassifications extends ListRecords
{
    protected static string $resource = InformationClassificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return __('Klasifikasi Informasi');
    }
}
