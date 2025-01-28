<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductModelResource\Pages;
use App\Filament\Resources\ProductModelResource\RelationManagers;
use App\Models\ProductModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductModelResource extends Resource
{
    protected static ?string $model = ProductModel::class;
    protected static ?string $navigationGroup = 'Manajemen Stok Barang';
    protected static ?string $navigationLabel = 'Input Barang';
    protected static ?string $navigationIcon = 'heroicon-o-cube';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\Select::make('category_id')
                ->relationship('category', 'name')
                ->preload()
                ->label('Kategori Barang')
                ->createOptionForm([
                    Forms\Components\TextInput::make('name')
                        ->label('Nama Kategori')
                        ->required(),
                ])
                ->required(),
            Forms\Components\Select::make('unit_id')
                ->label('Dalam Satuan')
                ->relationship('unit', 'name') // Relates to the Unit model
                ->searchable()
                ->preload()
                ->placeholder('Select a unit') // Optional placeholder for the dropdown
                ->nullable()
                ->required(), // Allows this field to be optional
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('category.name')->label(
                    'Kategori Barang'
                ),
                Tables\Columns\TextColumn::make('unit.name')->label(
                    'Dalam Satuan'
                ),
            ])
            ->filters([
                //
            ])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->defaultPaginationPageOption(25)
            ->extremePaginationLinks()
            ->deferLoading();
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
            'index' => Pages\ListProductModels::route('/'),
            'create' => Pages\CreateProductModel::route('/create'),
            'edit' => Pages\EditProductModel::route('/{record}/edit'),
        ];
    }
}
