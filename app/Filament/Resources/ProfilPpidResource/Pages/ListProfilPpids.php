<?php

namespace App\Filament\Resources\ProfilPpidResource\Pages;

use App\Filament\Resources\ProfilPpidResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListProfilPpids extends ListRecords
{
    protected static string $resource = ProfilPpidResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->visible(\App\Models\ProfilPpid::count() < 8),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return __(key: 'Petugas/Pejabat PPID');
    }
}
