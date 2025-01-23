<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use App\Models\ProductModel;

class CurrentStock extends Page implements Tables\Contracts\HasTable
{
    use InteractsWithTable;

    protected static string $view = 'filament.pages.current-stock';

    protected static ?string $navigationIcon = 'heroicon-o-document-check';
    protected static ?string $navigationLabel = 'Current Stock';
    protected static ?string $navigationGroup = 'Inventory Management';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(ProductModel::query())
            ->columns([
                TextColumn::make('name')->label('Product Name'),
                TextColumn::make('category.name')->label('Category'),
                TextColumn::make('currentStock.stock')
                    ->label('Current Stock')
                    ->getStateUsing(
                        fn($record) => $record
                            ->currentStock()
                            ->value('stock') ?? 0
                    ),
            ]);
    }
}
