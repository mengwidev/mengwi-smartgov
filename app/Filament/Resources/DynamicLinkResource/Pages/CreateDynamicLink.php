<?php

namespace App\Filament\Resources\DynamicLinkResource\Pages;

use App\Filament\Resources\DynamicLinkResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDynamicLink extends CreateRecord
{
    protected static string $resource = DynamicLinkResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
