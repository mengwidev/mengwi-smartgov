<?php

namespace App\Filament\Resources\MobileMenuResource\Pages;

use App\Filament\Resources\MobileMenuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMobileMenus extends ListRecords
{
    protected static string $resource = MobileMenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
