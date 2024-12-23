<?php

namespace App\Filament\Resources\MicrositePageResource\Pages;

use App\Filament\Resources\MicrositePageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMicrositePages extends ListRecords
{
    protected static string $resource = MicrositePageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
