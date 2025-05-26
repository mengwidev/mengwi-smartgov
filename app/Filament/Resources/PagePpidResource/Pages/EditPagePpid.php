<?php

namespace App\Filament\Resources\PagePpidResource\Pages;

use App\Filament\Resources\PagePpidResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditPagePpid extends EditRecord
{
    protected static string $resource = PagePpidResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getTitle(): string|Htmlable
    {
        return __(key: 'Edit Halaman Web PPID');
    }
}
