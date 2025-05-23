<?php

namespace App\Filament\Resources\PublicInformationApplicationResource\Pages;

use App\Filament\Resources\PublicInformationApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditPublicInformationApplication extends EditRecord
{
    protected static string $resource = PublicInformationApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return $this->record->reg_num ?? 'Permohonan Informasi';
    }
}
