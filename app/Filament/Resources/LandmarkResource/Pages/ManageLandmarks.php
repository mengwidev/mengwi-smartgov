<?php

namespace App\Filament\Resources\LandmarkResource\Pages;

use App\Filament\Resources\LandmarkResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageLandmarks extends ManageRecords
{
    protected static string $resource = LandmarkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
