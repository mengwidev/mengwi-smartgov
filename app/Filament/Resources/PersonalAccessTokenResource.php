<?php

namespace App\Filament\Resources;

use App\Models\User;
use App\Filament\Resources\PersonalAccessTokenResource\Pages;
use App\Models\PersonalAccessToken;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class PersonalAccessTokenResource extends Resource
{
    protected static ?string $model = PersonalAccessToken::class;
    protected static ?string $navigationIcon = 'heroicon-o-key';
    protected static ?string $navigationGroup = 'Authentication';
    protected static ?string $navigationLabel = 'API Token';
    protected static ?int $navigationSort = 3;

    public static function canCreate(): bool
    {
        return false; // Disable creation
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tokenable.name')
                    ->label('User')
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->whereHas('tokenable', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                    })
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query->join('users', 'users.id', '=', 'personal_access_tokens.tokenable_id')
                            ->orderBy('users.name', $direction);
                    }),

                Tables\Columns\TextColumn::make('name')
                    ->label('Token Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable(),

                // Tables\Columns\TextColumn::make('expires_at')
                //     ->label('Expires')
                //     ->dateTime()
                //     ->sortable()
                //     ->color(fn ($state) => $state?->isPast() ? 'danger' : 'success'),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make()
                    ->label('Revoke')
                    ->successNotificationTitle('Token revoked successfully'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Revoke selected'),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPersonalAccessTokens::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->select('personal_access_tokens.*')
            ->with('tokenable')
            ->withoutGlobalScopes();
    }
}
