<?php

namespace App\Filament\Resources\PagePpidCategoryResource\Pages;

use App\Filament\Resources\PagePpidCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditPagePpidCategory extends EditRecord
{
    protected static string $resource = PagePpidCategoryResource::class;

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
        return __(key: 'Edit Kategori Halaman Web PPID');
    }
}
