<?php

namespace App\Filament\Resources\SocialAssistanceResource\Pages;

use App\Filament\Resources\SocialAssistanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSocialAssistances extends ListRecords
{
    protected static string $resource = SocialAssistanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
