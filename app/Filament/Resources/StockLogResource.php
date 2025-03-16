<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StockLogResource\Pages;
use App\Models\ProductModel;
use App\Models\StockLogModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class StockLogResource extends Resource
{
    protected static ?string $model = StockLogModel::class;

    protected static ?string $navigationGroup = 'Manajemen Stok Barang';

    protected static ?string $navigationLabel = 'Input Barang Masuk/Keluar';

    protected static ?string $navigationIcon = 'heroicon-o-arrows-right-left';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make('3')->schema([
                Forms\Components\Section::make('Informasi Barang')
                    ->columnSpan(2)
                    ->icon('heroicon-o-cube')
                    ->description(
                        'Masukkan informasi barang yang akan masuk/keluar'
                    )
                    ->schema([
                        // BARANG --- column : product_id
                        Forms\Components\Select::make('product_id')
                            ->label('Barang')
                            ->relationship('product', 'name', function (
                                $query
                            ) {
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
                                if (! $state) {
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
                                    \App\Models\ProductModel::find($state)
                                        ?->unit->name ??
                                    'Silahkan pilih barang';
                                $set('unit', $unitName);
                            }),
                        Forms\Components\Section::make('Jenis Pergerakan Stok')
                            ->description(
                                'Masukkan tipe pergerakan stok (masuk/keluar) dan isikan jumlahnya. Pastikan jumlah keluar sesuai dengan jumlah stok saat ini.'
                            )
                            ->icon('heroicon-o-arrows-right-left')
                            ->compact()
                            ->schema([
                                Forms\Components\Split::make([
                                    // TIPE PERGERAKAN (MASUK/KELUAR) --- column : type
                                    Forms\Components\Select::make('type')
                                        ->label('Masuk/Keluar')
                                        ->options([
                                            'in' => 'Masuk',
                                            'out' => 'Keluar',
                                        ])
                                        ->reactive()
                                        ->required(),
                                    // QUANTITY
                                    Forms\Components\TextInput::make('quantity')
                                        ->label('Jumlah')
                                        ->numeric()
                                        ->reactive()
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
                                            $product = ProductModel::find(
                                                $productId
                                            );
                                            $remainingStock = $get(
                                                'remaining_stock'
                                            );

                                            if (
                                                $type === 'out' &&
                                                $remainingStock <= 0
                                            ) {
                                                Notification::make()
                                                    ->title('Gagal')
                                                    ->danger()
                                                    ->body(
                                                        'Stok kosong, tidak dapat mengeluarkan barang.'
                                                    )
                                                    ->send();
                                                $set('quantity', null);
                                            }

                                            if ($product) {
                                                if ($type === 'out') {
                                                    $currentStock =
                                                        $product
                                                            ->currentStock()
                                                            ->first()->stock ??
                                                        0;
                                                    if (
                                                        $state > $currentStock
                                                    ) {
                                                        $set('quantity', null);
                                                        Notification::make()
                                                            ->title('Gagal')
                                                            ->danger()
                                                            ->body(
                                                                'Tidak dapat mengeluarkan barang yang melebihi sisa stok!'
                                                            )
                                                            ->send();
                                                    }
                                                } elseif ($state === null) {
                                                    $set('quantity', null);
                                                    Notification::make()
                                                        ->title('Gagal')
                                                        ->danger()
                                                        ->body(
                                                            'Isi jumlah stok yang akan keluar!'
                                                        )
                                                        ->send();
                                                }
                                            }
                                        })
                                        ->required()
                                        ->disabled(
                                            fn (callable $get) => ! $get('type')
                                        ) // Disable if type is not selected
                                        ->suffix(function (callable $get) {
                                            return $get('unit') ?? '---';
                                        }),
                                ]),
                            ]),
                        Forms\Components\Section::make('Unit Kerja')
                            ->description(
                                'Silahkan pilih ke unit mana barang keluar.'
                            )
                            ->icon('heroicon-o-users')
                            ->compact()
                            ->schema([
                                // UNIT OUT
                                Forms\Components\Select::make('out_unit_id')
                                    ->relationship('unit', 'name', function (
                                        $query
                                    ) {
                                        $query->orderBy('id', 'asc');
                                    })
                                    ->preload()
                                    ->searchable()
                                    ->label('Unit Kerja'),
                            ])
                            ->hidden(
                                fn (callable $get) => $get('type') !== 'out'
                            ),
                    ]),
                Forms\Components\Section::make('Tanggal Pergerakan Stok')
                    ->columnSpan(1)
                    ->icon('heroicon-o-calendar-days')
                    ->compact()
                    ->description('Masukkan tanggal stok barang masuk/keluar')
                    ->schema([
                        // DATE
                        Forms\Components\DatePicker::make('date')
                            ->label('Tanggal')
                            ->default(now())
                            ->required(),
                    ]),
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
                        fn ($state) => $state === 'in'
                            ? 'Stok Masuk'
                            : 'Stok Keluar'
                    )
                    ->sortable(),
                Tables\Columns\TextColumn::make('unit.name')
                    ->label('Unit Kerja')
                    ->sortable()
                    ->formatStateUsing(
                        fn ($record) => $record->unit?->name ?? '--'
                    ),
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
