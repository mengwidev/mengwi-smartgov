<?php

namespace App\Filament\Resources\PagePpidResource\Pages;

use App\Filament\Resources\PagePpidResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListPagePpids extends ListRecords
{
    protected static string $resource = PagePpidResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getTitle(): string|Htmlable
    {
        return __(key: 'Halaman Web PPID');
    }
}
