<?php

namespace App\Filament\Resources\PersonalAccessTokenResource\Pages;

use App\Filament\Resources\PersonalAccessTokenResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\PersonalAccessToken;
use App\Models\User;
use Filament\Notifications\Notification;

class CreatePersonalAccessToken extends CreateRecord
{
    protected static string $resource = PersonalAccessTokenResource::class;

    protected function handleRecordCreation(array $data): PersonalAccessToken
    {
        $user = User::findOrFail($data['tokenable_id']);

        // Generate the token (this returns an object with plainTextToken)
        $tokenResult = $user->createToken($data['name'], ['*']);

        // Show the raw token in a success notification
        Notification::make()
            ->title('Token Created')
            ->success()
            ->body("Here is the token (copy it now):\n\n`{$tokenResult->plainTextToken}`")
            ->persistent() // stays until user dismisses
            ->send();

        // return $tokenResult->accessToken;
        return PersonalAccessToken::findOrFail($tokenResult->accessToken->id);
    }
}
