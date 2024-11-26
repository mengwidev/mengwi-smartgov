<?php

namespace App\Filament\Resources\DynamicLinkResource\Pages;

use App\Filament\Resources\DynamicLinkResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDynamicLink extends EditRecord
{
    protected static string $resource = DynamicLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
