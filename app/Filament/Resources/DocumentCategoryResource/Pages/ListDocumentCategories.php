<?php

namespace App\Filament\Resources\DocumentCategoryResource\Pages;

use App\Filament\Resources\DocumentCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListDocumentCategories extends ListRecords
{
    protected static string $resource = DocumentCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return __(key: 'Kategori Dokumen');
    }
}
