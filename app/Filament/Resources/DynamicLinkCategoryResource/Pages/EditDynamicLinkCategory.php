<?php

namespace App\Filament\Resources\DynamicLinkCategoryResource\Pages;

use App\Filament\Resources\DynamicLinkCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDynamicLinkCategory extends EditRecord
{
    protected static string $resource = DynamicLinkCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
