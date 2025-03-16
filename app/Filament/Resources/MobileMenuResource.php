<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MobileMenuResource\Pages;
use App\Models\MobileMenu;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class MobileMenuResource extends Resource
{
    protected static ?string $model = MobileMenu::class;

    protected static ?string $navigationIcon = 'heroicon-o-device-phone-mobile';

    protected static ?string $navigationGroup = 'Mobile Apps';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Judul Menu')
                    ->helperText('Masukkan judul menu yang akan tampil pada aplikasi Desa Mengwi')
                    ->required(),

                TextInput::make('url')
                    ->label('url')
                    ->helperText('Masukkan url menu yang akan diforward ke web (tanpa protokol)')
                    ->prefix('https://')
                    ->required(),

                TextInput::make('description')
                    ->label('Deskripsi Menu')
                    ->helperText('Isikan deskripsi menu (maksimal 110 karakter)')
                    ->maxLength(110)
                    ->rule('max:110', 'Deskripsi tidak boleh lebih dari 110 karakter.')
                    ->required(),

                TextInput::make('icon')
                    ->label('Icon Menu')
                    ->helperText('Daftar icon bisa dilihat pada https://oblador.github.io/react-native-vector-icons/')
                    ->required(),

                Forms\Components\ColorPicker::make('bgColor')
                    ->label('Warna Icon Box')
                    ->helperText('Pilih warna icon box pada menu')
                    ->regex('/^#[a-f0-9]{6}$/i')
                    ->required(),

                Forms\Components\Toggle::make('isActive')
                    ->label('Status Menu')
                    ->helperText('Ubah status menu tampil/tidak di Aplikasi Desa Mengwi')
                    ->onIcon('heroicon-m-check')
                    ->offIcon('heroicon-m-x-mark')
                    ->onColor('success')
                    ->offColor('danger')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Judul Menu'),
                TextColumn::make('url')
                    ->label('Url')
                    ->formatStateUsing(
                        fn ($state) => strlen($state) > 50
                            ? substr($state, 0, 50).'...'
                            : $state
                    ),
                TextColumn::make('description')
                    ->label('Deskripsi Menu')
                    ->formatStateUsing(
                        fn ($state) => strlen($state) > 30
                            ? substr($state, 0, 30).'...'
                            : $state
                    ),
                TextColumn::make('icon')
                    ->label('Icon Menu'),
                Tables\Columns\ColorColumn::make('bgColor')
                    ->label('Warna Icon Box'),
                ToggleColumn::make('isActive')
                    ->label('Status')
                    ->onIcon('heroicon-m-check')
                    ->offIcon('heroicon-m-x-mark')
                    ->onColor('success')
                    ->offColor('danger'),
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
            'index' => Pages\ListMobileMenus::route('/'),
            'create' => Pages\CreateMobileMenu::route('/create'),
            'edit' => Pages\EditMobileMenu::route('/{record}/edit'),
        ];
    }
}
