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

    /**
     * Handle the creation of a new personal access token.
     *
     * @param array $data The data for creating the token.
     * @return PersonalAccessToken The created token record.
     */
    protected function handleRecordCreation(array $data): PersonalAccessToken
    {
        // Retrieve the user based on the provided tokenable_id
        $user = User::findOrFail($data['tokenable_id']);

        $tokenResult = $user->createToken($data['name'], ['*']);
        $accessToken = $tokenResult->accessToken;

        // Send a notification with the token
        Notification::make()
            ->title('Token Created')
            ->success()
            ->body("Here is the generated token (copy it now):\n\n`{$tokenResult->plainTextToken}`")
            ->persistent()
            ->send();

        return $accessToken;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
