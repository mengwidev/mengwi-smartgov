<?php

namespace App\Filament\Resources\MobileMenuResource\Pages;

use App\Filament\Resources\MobileMenuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMobileMenu extends EditRecord
{
    protected static string $resource = MobileMenuResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
