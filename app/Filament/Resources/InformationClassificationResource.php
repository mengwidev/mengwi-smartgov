<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InformationClassificationResource\Pages;
use App\Filament\Resources\InformationClassificationResource\RelationManagers;
use App\Models\InformationClassification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InformationClassificationResource extends Resource
{
    protected static ?string $model = InformationClassification::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'PPID';

    protected static ?string $navigationParentItem = 'Informasi Publik';

    protected static ?string $navigationLabel = 'Klasifikasi Informasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('public_informations_count')
                    ->label('Jumlah Informasi')
                    ->counts('publicInformations'),
                Tables\Columns\TextColumn::make('description')
                    ->limit(100),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInformationClassifications::route('/'),
            'create' => Pages\CreateInformationClassification::route('/create'),
            'edit' => Pages\EditInformationClassification::route('/{record}/edit'),
        ];
    }
}
