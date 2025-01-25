<?php

namespace App\Filament\Pages;

use App\Models\ProductModel;
use App\Models\StockLogModel;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Filters\SelectFilter;
use Tables\Table;

class CurrentStock extends Page implements Tables\Contracts\HasTable
{
    use InteractsWithTable;

    protected static string $view = 'filament.pages.current-stock';

    protected static ?string $navigationIcon = 'heroicon-o-document-check';
    protected static ?string $navigationLabel = 'Rekap Stok';
    protected static ?string $navigationGroup = 'Inventory Management';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(
                ProductModel::query()
                    ->select(
                        'products.*',
                        'current_stock.stock as current_stock'
                    )
                    ->leftJoinSub(
                        StockLogModel::selectRaw(
                            'product_id, SUM(CASE WHEN type = "in" THEN quantity ELSE -quantity END) as stock'
                        )->groupBy('product_id'),
                        'current_stock',
                        'current_stock.product_id',
                        '=',
                        'products.id'
                    )
            )
            ->columns([
                TextColumn::make('name')->label('Barang')->searchable(),
                TextColumn::make('category.name')->label('Kategori'),
                TextColumn::make('currentStock.stock')
                    ->label('Jumlah Stok')
                    ->getStateUsing(
                        fn($record) => $record
                            ->currentStock()
                            ->value('stock') ?? 0
                    ),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name'),
            ]);
    }
}
