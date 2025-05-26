<?php

namespace App\Filament\Resources\PagePpidCategoryResource\Pages;

use App\Filament\Resources\PagePpidCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreatePagePpidCategory extends CreateRecord
{
    protected static string $resource = PagePpidCategoryResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getTitle(): string|Htmlable
    {
        return __(key: 'Tambah Kategori Halaman Web PPID');
    }
}
