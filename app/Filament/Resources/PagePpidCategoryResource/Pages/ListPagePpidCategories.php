<?php

namespace App\Filament\Resources\PagePpidCategoryResource\Pages;

use App\Filament\Resources\PagePpidCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListPagePpidCategories extends ListRecords
{
    protected static string $resource = PagePpidCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return __(key: 'Kategori Halaman Web PPID');
    }
}
