<?php

namespace App\Filament\Resources\ProfilPpidResource\Pages;

use App\Filament\Resources\ProfilPpidResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProfilPpids extends ListRecords
{
    protected static string $resource = ProfilPpidResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
