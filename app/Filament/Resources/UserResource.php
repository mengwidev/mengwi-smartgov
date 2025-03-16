<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Validation\Rules\Password;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'Pengaturan';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\Section::make('Informasi User')
                    ->columnSpan(1)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label('Nama Lengkap')
                            ->validationMessages([
                                'required' => 'Kolom wajib diisi.',
                                'max' => 'Nama Lengkap tidak boleh lebih dari 255 karakter.',
                            ]),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->label('Email')
                            ->validationMessages([
                                'required' => 'Kolom wajib diisi.',
                                'unique' => 'Email sudah terdaftar!',
                            ]),
                        Forms\Components\TextInput::make('username')
                            ->required()
                            ->maxLength(255)
                            ->label('Username')
                            ->unique()
                            ->validationMessages([
                                'required' => 'Kolom wajib diisi.',
                                'unique' => 'Username sudah digunakan!',
                            ]),

                        Forms\Components\Hidden::make('email_verified_at')
                            ->label('Email Verified At')
                            ->default(now()),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->required(
                                fn ($livewire) => $livewire instanceof Pages\CreateUser
                            )
                            ->maxLength(255)
                            ->label('Password')
                            ->helperText(
                                'Password harus minimal 8 karakter, mengandung angka dan simbol'
                            )
                            ->rule(
                                Password::min(8)
                                    ->letters()
                                    ->numbers()
                                    ->symbols()
                            )
                            ->dehydrated(fn ($state) => filled($state))
                            ->nullable()
                            ->validationMessages([
                                'required' => 'Kolom wajib diisi.',
                                'min' => 'Password harus minimal 8 karakter!',
                                'password.symbols' => 'Password harus mengandung simbol!',
                                'password.numbers' => 'Passwpord harus mengandung angka!',
                            ]),
                        Forms\Components\TextInput::make(
                            'password_confirmation'
                        )
                            ->password()
                            ->required(
                                fn ($livewire) => $livewire instanceof Pages\CreateUser
                            ) // Only required on create
                            ->same('password')
                            ->label('Konfirmasi Password')
                            ->helperText(
                                'Masukkan kembali password untuk konfirmasi'
                            )
                            ->nullable()
                            ->validationMessages([
                                'required' => 'Kolom wajib diisi.',
                                'same' => 'Password tidak sama!',
                                'min' => 'Password harus minimal 8 karakter!',
                            ]),
                    ]),
                Forms\Components\Section::make('Role Assignment')
                    ->columnSpan(1)
                    ->schema([
                        Forms\Components\Select::make('roles')
                            ->relationship('roles', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->required()
                            ->label('Roles')
                            ->reactive()
                            ->afterStateUpdated(
                                fn ($state, $get) => $get('roles')
                                    ? null
                                    : $get('roles')
                            )
                            ->validationMessages([
                                'required' => 'Kolom wajib diisi.',
                            ]),
                    ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Full Name'),
                Tables\Columns\TextColumn::make('username')
                    ->searchable()
                    ->label('Username'),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->label('Email'),
                Tables\Columns\TextColumn::make('roles.name')->label('Roles'),
            ])
            ->filters([
                // Example filters can be added later
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
