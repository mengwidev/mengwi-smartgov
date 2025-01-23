<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StockLogResource\Pages;
use App\Filament\Resources\StockLogResource\RelationManagers;
use App\Models\StockLogModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StockLogResource extends Resource
{
    protected static ?string $model = StockLogModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrows-right-left';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('product_id')
                ->label('Product')
                ->relationship('product', 'name') // Relates to the Product model
                ->required()
                ->preload()
                ->searchable(),

            Forms\Components\Select::make('unit_id')
                ->label('Unit')
                ->relationship('unit', 'name') // Relates to the Unit model
                ->searchable()
                ->preload()
                ->placeholder('Select a unit') // Optional placeholder for the dropdown
                ->nullable(), // Allows this field to be optional

            Forms\Components\Select::make('type')
                ->label('Stock Type')
                ->options([
                    'in' => 'Stock In',
                    'out' => 'Stock Out',
                ])
                ->required(),

            Forms\Components\TextInput::make('quantity')
                ->label('Quantity')
                ->numeric()
                ->required(),

            Forms\Components\DatePicker::make('date')
                ->label('Date')
                ->default(now())
                ->required(),

            Forms\Components\TextInput::make('log_id')
                ->label('Log ID')
                ->disabled(), // Prevent manual input as it should be auto-generated
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('log_id')
                    ->label('Log ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Product')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('unit.name')
                    ->label('Unit')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Stock Type')
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->label('Quantity')
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Added By')
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStockLogs::route('/'),
            'create' => Pages\CreateStockLog::route('/create'),
            'edit' => Pages\EditStockLog::route('/{record}/edit'),
        ];
    }
}
