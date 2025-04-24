<?php

namespace App\Filament\Resources;

use App\Models\User;
use App\Filament\Resources\PersonalAccessTokenResource\Pages;
use App\Filament\Resources\PersonalAccessTokenResource\RelationManagers;
use App\Models\PersonalAccessToken;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\DeleteAction;

class PersonalAccessTokenResource extends Resource
{
    protected static ?string $model = PersonalAccessToken::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Token Name')
                ->required(),
            Forms\Components\TextInput::make('service')
                ->label('Service')
                ->maxLength(255),
            Forms\Components\TextInput::make('used_at')
                ->label('Last Used At')
                ->disabled(),
            Forms\Components\TextInput::make('last_handshake')
                ->label('Last Handshake')
                ->disabled(),
            Forms\Components\Select::make('tokenable_id')
                ->label('User')
                ->options(User::all()->pluck('name', 'id'))
                ->required(),
        ]);
    }

    public static function create(Form $form)
    {
        $data = $form->getState();

        // Generate the token for the selected user
        $user = User::find($data['tokenable_id']); // Find the user by selected ID
        $token = $user->createToken($data['name'], ['*']); // Generate the token with all permissions (or specify scopes)

        // Create the record in the personal_access_tokens table
        PersonalAccessToken::create([
            'name' => $data['name'],
            'service' => $data['service'],
            'tokenable_type' => User::class, // Or any other model you're using
            'tokenable_id' => $user->id,
            'used_at' => null, // Set as null initially
            'last_handshake' => null, // Set as null initially
        ]);

        return redirect()->route('filament.resources.personal-access-tokens.index'); // Redirect after creation
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')
                ->label('Token Name')
                ->searchable(),
            Tables\Columns\TextColumn::make('service')
                ->label('Service')
                ->searchable(),
            Tables\Columns\TextColumn::make('used_at')
                ->label('Last Used At')
                ->sortable()
                ->dateTime('Y-m-d H:i:s'),
            Tables\Columns\TextColumn::make('last_handshake')
                ->label('Last Handshake')
                ->sortable()
                ->dateTime('Y-m-d H:i:s'),
            Tables\Columns\TextColumn::make('created_at')
                ->label('Created At'),
            Tables\Columns\TextColumn::make('updated_at')
                ->label('Updated At'),
            ])
            ->filters([
                //
            ])
            ->actions([
                DeleteAction::make()->label('Revoke Token')->action(function (PersonalAccessToken $record) {
                    $record->tokenable->tokens->find($record->id)->delete(); // Revoke the actual token
                    $record->delete(); // Optionally, also delete the record in the `personal_access_tokens` table
                }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPersonalAccessTokens::route('/'),
            'create' => Pages\CreatePersonalAccessToken::route('/create'),
            'edit' => Pages\EditPersonalAccessToken::route('/{record}/edit'),
        ];
    }
}
