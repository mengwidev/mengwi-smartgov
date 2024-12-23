<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MicrositePageResource\Pages;
use App\Filament\Resources\MicrositePageResource\RelationManagers;
use App\Models\MicrositePage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Route;

class MicrositePageResource extends Resource
{
    protected static ?string $model = MicrositePage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('logo'),
                Forms\Components\TextInput::make('title')
                    ->label('Judul')
                    ->required(),
                Forms\Components\TextInput::make('description')
                    ->label('Deskripsi')
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo')->label('Logo'),
                Tables\Columns\TextColumn::make('title')->label('Judul')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('description')->label('Deskripsi')->limit(50),
                Tables\Columns\TextColumn::make('created_at')->label('Dibuat')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Custom Copy URL Action
                Action::make('visitPage')
                    ->label('Visit')
                    ->icon('heroicon-o-arrow-up-right')
                    ->color('success')
                    ->url(fn($record) => route('microsite.show', $record->slug))
                    ->openUrlInNewTab()
                    ->tooltip('Open the public show URL in a new tab'),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            RelationManagers\LinkRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMicrositePages::route('/'),
            'create' => Pages\CreateMicrositePage::route('/create'),
            'edit' => Pages\EditMicrositePage::route('/{record}/edit'),
        ];
    }
}
