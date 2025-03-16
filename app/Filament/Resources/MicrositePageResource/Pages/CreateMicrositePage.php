<?php

namespace App\Filament\Resources\MicrositePageResource\Pages;

use App\Filament\Resources\MicrositePageResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMicrositePage extends CreateRecord
{
    protected static string $resource = MicrositePageResource::class;

    // protected function getRedirectUrl(): string
    // {
    //     return $this->getResource()::getUrl('index');
    // }
}
