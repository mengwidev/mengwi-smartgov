<?php

namespace App\Filament\Resources\DocumentCategoryResource\Pages;

use App\Filament\Resources\DocumentCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateDocumentCategory extends CreateRecord
{
    protected static string $resource = DocumentCategoryResource::class;

    public function getTitle(): string|Htmlable
    {
        return __(key: 'Tambah Kategori Dokumen');
    }
}
