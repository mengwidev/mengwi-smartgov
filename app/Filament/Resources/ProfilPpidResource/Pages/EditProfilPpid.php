<?php

namespace App\Filament\Resources\ProfilPpidResource\Pages;

use App\Filament\Resources\ProfilPpidResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProfilPpid extends EditRecord
{
    protected static string $resource = ProfilPpidResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
