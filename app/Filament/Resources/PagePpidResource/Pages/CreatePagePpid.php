<?php

namespace App\Filament\Resources\PagePpidResource\Pages;

use App\Filament\Resources\PagePpidResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreatePagePpid extends CreateRecord
{
    protected static string $resource = PagePpidResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getTitle(): string|Htmlable
    {
        return __(key: 'Buat Halaman Web PPID');
    }
}
