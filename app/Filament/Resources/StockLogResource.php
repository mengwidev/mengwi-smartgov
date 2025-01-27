<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StockLogResource\Pages;
use App\Filament\Resources\StockLogResource\RelationManagers;
use App\Models\ProductModel;
use App\Models\StockLogModel;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;

class StockLogResource extends Resource
{
    protected static ?string $model = StockLogModel::class;
    protected static ?string $navigationGroup = 'Manajemen Stok Barang';
    protected static ?string $navigationLabel = 'Input Barang Masuk/Keluar';
    protected static ?string $navigationIcon = 'heroicon-o-arrows-right-left';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Barang')
                ->description(
                    'Pilih barang masuk/keluar sesuai barang yang sudah diinput pada menu "Input Barang"'
                )
                ->columns(3)
                ->schema([
                    // BARANG --- column : product_id
                    Forms\Components\Select::make('product_id')
                        ->label('Barang')
                        ->columnSpan(2)
                        ->relationship('product', 'name', function ($query) {
                            $query->orderBy('id', 'desc');
                        })
                        ->required()
                        ->preload()
                        ->searchable()
                        ->reactive()
                        ->afterStateUpdated(function (
                            $state,
                            callable $set,
                            callable $get
                        ) {
                            if (!$state) {
                                $set(
                                    'remaining_stock',
                                    'Silahkan pilih barang'
                                );
                                $set('unit', '---');
                                return;
                            }

                            // Calculate current stock based on stock logs
                            $stockIn = StockLogModel::where(
                                'product_id',
                                $state
                            )
                                ->where('type', 'in')
                                ->sum('quantity');
                            $stockOut = StockLogModel::where(
                                'product_id',
                                $state
                            )
                                ->where('type', 'out')
                                ->sum('quantity');
                            $currentStock = $stockIn - $stockOut;

                            // Set dynamic values for the helper text and other fields
                            $set('remaining_stock', $currentStock);

                            $unitName =
                                \App\Models\ProductModel::find($state)?->unit
                                    ->name ?? 'Silahkan pilih barang';
                            $set('unit', $unitName);
                        }),

                    // TIPE PERGERAKAN (MASUK/KELUAR) --- column : type
                    Forms\Components\Select::make('type')
                        ->label('Masuk/Keluar')
                        ->options([
                            'in' => 'Masuk',
                            'out' => 'Keluar',
                        ])
                        ->required(),
                ]),

            Forms\Components\Section::make('Informasi Pergerakan Stok')
                ->description(
                    'Masukkan informasi jumlah pergerakan stok yang masuk/keluar dan tanggal pergerakan stok.'
                )
                ->columns(2)
                ->schema([
                    Forms\Components\Section::make('Jumlah Masuk/Keluar')
                        ->columnSpan(1)
                        ->description(
                            'Masukkan jumlah stok masuk/keluar. Untuk stok keluar pastikan jumlahnya sesuai dengan jumlah stok saat ini.'
                        )
                        ->schema([
                            Forms\Components\TextInput::make('quantity')
                                ->label('Jumlah')
                                ->numeric()
                                ->reactive()
                                ->extraAttributes([
                                    'class' =>
                                        'text-lg font-semibold text-blue-500',
                                ])
                                ->helperText(function (callable $get) {
                                    $remainingStock =
                                        $get('remaining_stock') ??
                                        '-- silahkan pilih barang --';
                                    return "Stok tersisa: $remainingStock";
                                })
                                ->rule(['integer', 'min:1'])
                                ->afterStateUpdated(function (
                                    $state,
                                    callable $get,
                                    callable $set
                                ) {
                                    $type = $get('type');
                                    $productId = $get('product_id');
                                    $product = ProductModel::find($productId);

                                    if ($product) {
                                        // For "out" type, we validate the quantity doesn't exceed current stock
                                        if ($type === 'out') {
                                            $currentStock =
                                                $product
                                                    ->currentStock()
                                                    ->first()->stock ?? 0;

                                            if ($state > $currentStock) {
                                                // Set quantity to current stock if entered quantity exceeds available stock
                                                $set('quantity', $currentStock);
                                            }
                                        } elseif ($state === null) {
                                            // Auto-fill quantity with current stock if the field is blank
                                            $set(
                                                'quantity',
                                                $product
                                                    ->currentStock()
                                                    ->first()->stock ?? 0
                                            );
                                        }
                                    }
                                })
                                ->required()
                                ->suffix(function (callable $get) {
                                    return $get('unit') ?? '---';
                                }),
                        ]),
                    Forms\Components\Section::make('Tanggal Masuk/Keluar')
                        ->description(
                            'Masukkan tanggal kapan stok masuk/keluar'
                        )
                        ->columnSpan(1)
                        ->schema([
                            Forms\Components\DatePicker::make('date')
                                ->label('Tanggal')
                                ->default(now())
                                ->required(),
                        ])
                        ->grow(false),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('log_id')
                    ->label('Nomor Log')
                    ->sortable(),
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Barang')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Pergerakan Stok')
                    ->formatStateUsing(
                        fn($state) => $state === 'in'
                            ? 'Stok Masuk'
                            : 'Stok Keluar'
                    )
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->label('Jumlah')
                    ->sortable(),
                Tables\Columns\TextColumn::make('product.unit.name')
                    ->label('Satuan')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->label('Tanggal')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Diinput Oleh')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Pergerakan Stok')
                    ->options([
                        'in' => 'Stok Masuk',
                        'out' => 'Stok Keluar',
                    ]),

                Tables\Filters\Filter::make('date')
                    ->label('Tanggal')
                    ->form([
                        Forms\Components\DatePicker::make('start_date')->label(
                            'Tanggal Mulai'
                        ),
                        Forms\Components\DatePicker::make('end_date')->label(
                            'Tanggal Akhir'
                        ),
                    ])
                    ->query(function (Builder $query, array $data) {
                        if ($data['start_date'] ?? null) {
                            $query->whereDate(
                                'date',
                                '>=',
                                $data['start_date']
                            );
                        }

                        if ($data['end_date'] ?? null) {
                            $query->whereDate('date', '<=', $data['end_date']);
                        }
                    }),

                SelectFilter::make('user_id')
                    ->label('Diinput Oleh')
                    ->relationship('user', 'name') // Assumes a relationship with the User model
                    ->searchable(), // Allow searching for users
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->defaultSort('date', 'desc');
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
