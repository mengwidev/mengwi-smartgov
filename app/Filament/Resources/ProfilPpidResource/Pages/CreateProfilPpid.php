<?php

namespace App\Filament\Resources\ProfilPpidResource\Pages;

use App\Filament\Resources\ProfilPpidResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateProfilPpid extends CreateRecord
{
    protected static string $resource = ProfilPpidResource::class;

    public function getTitle(): string|Htmlable
    {
        return __(key: 'Tambah Petugas/Pejabat PPID');
    }

    public static function canAccess(array $parameters = []): bool
    {
        return \App\Models\ProfilPpid::count() < 8;
    }
}
