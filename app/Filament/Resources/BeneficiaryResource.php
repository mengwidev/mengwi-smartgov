<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeneficiaryResource\Pages;
use App\Filament\Resources\BeneficiaryResource\RelationManagers;
use App\Models\Beneficiary;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Dotswan\MapPicker\Fields\Map;
use Filament\Forms\Set;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\CreateAction;

class BeneficiaryResource extends Resource
{
    protected static ?string $model = Beneficiary::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';

    protected static ?string $navigationGroup = 'Bantuan';

    protected static ?string $navigationLabel = 'Penerima Manfaat';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Pribadi')
                    ->icon('heroicon-o-user')
                    ->description('Data Pribadi Penerima Manfaat')
                    ->schema([
                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\TextInput::make('nomor_induk_kependudukan')
                                ->label('NIK')
                                ->required()
                                ->length(16)
                                ->numeric(),

                            Forms\Components\TextInput::make('nomor_kk')
                                ->label('Nomor KK')
                                ->required()
                                ->length(16)
                                ->numeric(),
                        ]),

                        Forms\Components\TextInput::make('nama_lengkap')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Select::make('banjar_id')
                            ->label('Alamat (Banjar)')
                            ->relationship('banjar', 'name') // Assuming 'name' column
                            ->required()
                            ->searchable()
                            ->preload(),

                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\TextInput::make('tempat_lahir')
                                ->required()
                                ->label('Tempat Lahir'),

                            Forms\Components\DatePicker::make('tanggal_lahir')
                                ->required()
                                ->native(false)
                                ->label('Tanggal Lahir')
                                ->displayFormat('d/m/Y')
                                ->locale('id')
                                ->weekStartsOnMonday()
                                ->closeOnDateSelection()
                                ->maxDate(now())
                                ->helperText('tangga/bulan/tahun')
                        ])
                    ]),

                Forms\Components\Section::make('Bantuan Sosial')
                    ->icon('heroicon-o-heart')
                    ->description('Jenis bantuan sosial yang diperoleh')
                    ->schema([
                        Forms\Components\Select::make('socialAssistances')
                            ->label('Jenis Bantuan Sosial')
                            ->relationship('socialAssistances', 'name')
                            ->multiple()
                            ->required()
                            ->searchable()
                            ->preload()
                            ->helperText('Silahkan memilih lebih dari satu jenis bantuan')
                            ->createOptionForm([ // Optional: allow creating new types
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Bantuan')
                                    ->required(),
                                Forms\Components\Textarea::make('description')
                                    ->label('Deskripsi'),
                            ]),
                    ]),

                Forms\Components\Section::make('Informasi Geospasial')
                    ->icon('heroicon-o-globe-asia-australia')
                    ->description('Informasi geospasial penerima manfaat')
                    ->schema([
                        Map::make('map_location')
                            ->label('Lokasi')
                            ->draggable(true)
                            ->clickable(true)
                            ->zoom(15)
                            ->minZoom(0)
                            ->maxZoom(28)
                            ->extraStyles([
                                'max-height: 50vh',
                            ])
                            ->defaultLocation(latitude: -8.543714321698051, longitude: 115.16994011147789)
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

                        Forms\Components\Grid::make(2)
                            ->schema([

                                Forms\Components\TextInput::make('latitude')
                                    ->reactive()
                                    ->readOnly()
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

                                Forms\Components\TextInput::make('longitude')
                                    ->reactive()
                                    ->readOnly()
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
                            ])
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nomor_induk_kependudukan')
                    ->label('NIK')
                    ->searchable(),

                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->searchable(),

                Tables\Columns\TextColumn::make('nomor_kk')
                    ->label('No. KK')
                    ->searchable(),

                Tables\Columns\TextColumn::make('banjar.name')
                    ->label('Banjar')
                    ->searchable(),

                Tables\Columns\TextColumn::make('socialAssistances.name')
                    ->label('Bantuan Sosial')
                    ->badge()
                    ->separator(', ')
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([
                Action::make('goToSocialAssistance')
                    ->label('Jenis Bantuan Sosial')
                    // ->icon('heroicon-o-heart')
                    ->color('info')
                    ->url(route('filament.admin.resources.social-assistances.index'))
                    ->openUrlInNewTab(false), // Or true for new tab
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
            'index' => Pages\ListBeneficiaries::route('/'),
            'create' => Pages\CreateBeneficiary::route('/create'),
            'edit' => Pages\EditBeneficiary::route('/{record}/edit'),
        ];
    }
}
