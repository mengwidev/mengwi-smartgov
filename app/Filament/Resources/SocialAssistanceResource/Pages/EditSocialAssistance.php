<?php

namespace App\Filament\Resources\SocialAssistanceResource\Pages;

use App\Filament\Resources\SocialAssistanceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSocialAssistance extends EditRecord
{
    protected static string $resource = SocialAssistanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
