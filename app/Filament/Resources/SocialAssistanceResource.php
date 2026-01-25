<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocialAssistanceResource\Pages;
use App\Filament\Resources\SocialAssistanceResource\RelationManagers;
use App\Models\SocialAssistance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\CreateAction;

class SocialAssistanceResource extends Resource
{
    protected static ?string $model = SocialAssistance::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->limit(80)
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([
                Action::make('goToBeneficiary')
                    ->label('Kembali ke Penerima Manfaat')
                    // ->icon('heroicon-o-heart')
                    ->color('info')
                    ->url(route('filament.admin.resources.beneficiaries.index'))
                    ->openUrlInNewTab(false), // Or true for new tab
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSocialAssistances::route('/'),
            'create' => Pages\CreateSocialAssistance::route('/create'),
            'edit' => Pages\EditSocialAssistance::route('/{record}/edit'),
        ];
    }
}
