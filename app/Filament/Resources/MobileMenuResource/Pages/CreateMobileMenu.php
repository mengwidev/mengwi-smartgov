<?php

namespace App\Filament\Resources\MobileMenuResource\Pages;

use App\Filament\Resources\MobileMenuResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMobileMenu extends CreateRecord
{
    protected static string $resource = MobileMenuResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
