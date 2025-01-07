<?php

namespace App\Filament\Resources\DynamicLinkCategoryResource\Pages;

use App\Filament\Resources\DynamicLinkCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDynamicLinkCategories extends ListRecords
{
    protected static string $resource = DynamicLinkCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
