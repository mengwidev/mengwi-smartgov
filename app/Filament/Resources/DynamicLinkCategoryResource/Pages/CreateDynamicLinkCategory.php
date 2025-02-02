<?php

namespace App\Filament\Resources\DynamicLinkCategoryResource\Pages;

use App\Filament\Resources\DynamicLinkCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDynamicLinkCategory extends CreateRecord
{
    protected static string $resource = DynamicLinkCategoryResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
