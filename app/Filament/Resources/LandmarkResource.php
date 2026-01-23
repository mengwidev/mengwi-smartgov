<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LandmarkResource\Pages;
use App\Filament\Resources\LandmarkResource\RelationManagers;
use App\Models\Landmark;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Dotswan\MapPicker\Fields\Map;
use Filament\Forms\Set;

class LandmarkResource extends Resource
{
    protected static ?string $model = Landmark::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationGroup = 'Kewilayahan';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(2)->schema([
                    Forms\Components\Section::make('Informasi Lokasi')
                    ->icon('heroicon-o-globe-americas')
                    ->schema([
                        // INFORMASI ALAMAT
                        Forms\Components\TextInput::make('name')
                            ->label('Name Tempat')
                            ->required()
                            ->maxLength(255),

                        // INFORMASI LOKASI
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->required(),

                        Map::make('map_location')
                            ->label('Lokasi')
                            ->draggable(true)
                            ->clickable(true)
                            ->zoom(15)
                            ->minZoom(0)
                            ->maxZoom(28)
                            ->defaultLocation(latitude: -8.543714321698051, longitude:115.16994011147789)
                            ->columnSpanFull()
                            ->afterStateHydrated(function ($state, $record, Set $set): void {
                                if ($record) {
                                    $set('map_location', [
                                        'lat' => $record->latitude,
                                        'lng' => $record->longitude
                                    ]);
                                    // Also set the combined location
                                    $set('coordinate', $record->latitude . ', ' . $record->longitude);
                                } else {
                                    $set('map_location', [
                                        'lat' => -8.543714321698051,
                                        'lng' => 115.16994011147789
                                    ]);
                                }
                            })
                            ->afterStateUpdated(function ($state, Set $set): void {
                                // Update all fields when map changes
                                if (is_array($state)) {
                                    $lat = $state['lat'] ?? null;
                                    $lng = $state['lng'] ?? null;

                                    $set('latitude', $lat);
                                    $set('longitude', $lng);

                                    // Update combined location field
                                    if ($lat && $lng) {
                                        $set('coordinate', $lat . ', ' . $lng);
                                    }
                                }
                            })
                            ->dehydrated(false)
                            ->live(),
                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\Hidden::make('latitude')
                                ->reactive()
                                ->default(-8.543714321698051)
                                ->afterStateUpdated(function ($state, Set $set, $get): void {
                                    // Update map when latitude changes
                                    $lng = $get('longitude');
                                    if ($state && $lng) {
                                        $set('map_location', [
                                            'lat' => $state,
                                            'lng' => $lng
                                        ]);
                                    }
                                }),

                            Forms\Components\Hidden::make('longitude')
                                ->reactive()
                                ->default(115.16994011147789)
                                ->afterStateUpdated(function ($state, Set $set, $get): void {
                                    // Update map when longitude changes
                                    $lat = $get('latitude');
                                    if ($state && $lat) {
                                        $set('map_location', [
                                            'lat' => $lat,
                                            'lng' => $state
                                        ]);
                                    }
                                }),

                            // Combined location field
                            Forms\Components\TextInput::make('coordinate')
                                ->label('Koordinat')
                                ->required()
                                ->readOnly()
                                ->helperText('Koordinat dihasilkan otomatis dari peta')
                                ->default('-8.543714321698051, 115.16994011147789')
                                ->columnSpanFull()
                                ->afterStateHydrated(function ($state, $record, Set $set): void {
                                    if ($record && $record->latitude && $record->longitude) {
                                        $set('coordinate', $record->latitude . ', ' . $record->longitude);
                                    }
                                })
                                ->afterStateUpdated(function ($state, Set $set, $get): void {
                                    // If user manually types in the combined location, parse it
                                    if (is_string($state) && str_contains($state, ',')) {
                                        $parts = explode(',', $state);
                                        if (count($parts) >= 2) {
                                            $lat = trim($parts[0]);
                                            $lng = trim($parts[1]);
                                            $set('latitude', $lat);
                                            $set('longitude', $lng);
                                            $set('map_location', [
                                                'lat' => $lat,
                                                'lng' => $lng
                                            ]);
                                        }
                                    }
                                }),
                        ]),
                    ]),
                    // UPLOAD FOTO
                    Forms\Components\Section::make('Foto/Gambar Lokasi')
                        ->description('Optional')
                        ->icon('heroicon-o-photo')
                        ->schema([
                            Forms\Components\FileUpload::make('picture')
                            ->label('Upload Foto/Gambar Lokasi')
                            ->helperText('Ukuran Maksimum: 2MB')
                            ->disk('public')
                            ->directory('landmarks/pictures')
                            ->image()
                            ->maxSize(2048)
                            ->visibility('public'),
                        ])
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('picture')
                    ->label('')
                    ->circular()
                    ->height(40),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Tempat')
                    ->searchable()
                    ->limit(40),

                Tables\Columns\TextColumn::make('description')
                    ->label('Uraian')
                    ->searchable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('coordinate')
                    ->label('Koordinat')
                    ->searchable()
                    ->copyable() // This adds a copy icon
                    ->copyMessage('Koordinat disalin!')
                    ->copyMessageDuration(1500)
                    ->tooltip('Klik untuk menyalin koordinat!')
                    ->icon('heroicon-o-clipboard')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageLandmarks::route('/'),
        ];
    }
}
