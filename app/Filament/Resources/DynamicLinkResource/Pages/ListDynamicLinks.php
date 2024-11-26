<?php

namespace App\Filament\Resources\DynamicLinkResource\Pages;

use App\Filament\Resources\DynamicLinkResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDynamicLinks extends ListRecords
{
    protected static string $resource = DynamicLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
