<?php

namespace App\Filament\Resources\PublicInformationApplicationResource\Pages;

use App\Filament\Resources\PublicInformationApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPublicInformationApplications extends ListRecords
{
    protected static string $resource = PublicInformationApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
