<?php

namespace App\Filament\Resources\MicrositePageResource\Pages;

use App\Filament\Resources\MicrositePageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMicrositePage extends EditRecord
{
    protected static string $resource = MicrositePageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
