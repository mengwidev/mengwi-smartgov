<?php

namespace App\Filament\Resources\DynamicLinkCategoryResource\Pages;

use App\Filament\Resources\DynamicLinkCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListDynamicLinkCategories extends ListRecords
{
    protected static string $resource = DynamicLinkCategoryResource::class;
    protected static ?string $navigationGroup = 'Alat';
    protected static ?string $navigationParentItem = 'Dynamic Link';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
