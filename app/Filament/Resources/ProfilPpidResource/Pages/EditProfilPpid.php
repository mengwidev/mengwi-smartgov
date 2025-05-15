<?php

namespace App\Filament\Resources\ProfilPpidResource\Pages;

use App\Filament\Resources\ProfilPpidResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditProfilPpid extends EditRecord
{
    protected static string $resource = ProfilPpidResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return __(key: 'Edit Petugas/Pejabat PPID');
    }
}
