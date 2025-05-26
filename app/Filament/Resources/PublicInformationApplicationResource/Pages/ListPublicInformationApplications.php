<?php

namespace App\Filament\Resources\PublicInformationApplicationResource\Pages;

use App\Filament\Resources\PublicInformationApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListPublicInformationApplications extends ListRecords
{
    protected static string $resource = PublicInformationApplicationResource::class;

    public function getTitle(): string|Htmlable
    {
        return __(key: 'Daftar Pemohon Informasi Publik');
    }
}
