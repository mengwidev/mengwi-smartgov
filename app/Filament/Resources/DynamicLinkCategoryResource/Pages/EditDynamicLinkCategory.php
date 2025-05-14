<?php

namespace App\Filament\Resources\DynamicLinkCategoryResource\Pages;

use App\Filament\Resources\DynamicLinkCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditDynamicLinkCategory extends EditRecord
{
    protected static string $resource = DynamicLinkCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getTitle(): string|Htmlable
    {
        return __(key: 'Edit Kategori Dokumen');
    }
}
