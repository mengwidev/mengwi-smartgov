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
                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\TextInput::make('lattitude')->required(),
                            Forms\Components\TextInput::make('longitude')->required()
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
                    ->limit(80),

                Tables\Columns\TextColumn::make('lattitude')
                    ->label('Koordinat (Lattitude)')
                    ->searchable()
                    ->copyable() // This adds a copy icon
                    ->copyMessage('Koordinat disalin!')
                    ->copyMessageDuration(1500)
                    ->tooltip('Klik untuk menyalin koordinat!')
                    ->icon('heroicon-o-clipboard')
                    ->limit(40),

                Tables\Columns\TextColumn::make('longitude')
                    ->label('Koordinat (Longitude)')
                    ->searchable()
                    ->copyable() // This adds a copy icon
                    ->copyMessage('Koordinat disalin!')
                    ->copyMessageDuration(1500)
                    ->tooltip('Klik untuk menyalin koordinat!')
                    ->icon('heroicon-o-clipboard')
                    ->limit(40),
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
