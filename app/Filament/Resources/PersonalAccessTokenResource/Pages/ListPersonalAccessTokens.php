<?php

namespace App\Filament\Resources\PersonalAccessTokenResource\Pages;

use App\Filament\Resources\PersonalAccessTokenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListPersonalAccessTokens extends ListRecords
{
    protected static string $resource = PersonalAccessTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return __('API Token');
    }
}
