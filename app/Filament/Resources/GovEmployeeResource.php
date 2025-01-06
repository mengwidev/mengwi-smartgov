<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GovEmployeeResource\Pages;
use App\Models\GovEmployee;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;

class GovEmployeeResource extends Resource
{
    protected static ?string $model = GovEmployee::class;
    protected static ?string $navigationGroup = 'Kepegawaian';
    protected static ?string $navigationLabel = 'Daftar Pegawai';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(12)->schema([
                Forms\Components\Section::make('')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama')
                            ->helperText(
                                'Isikan nama tanpa gelar depan dan gelar belakang.'
                            )
                            ->required(),

                        Forms\Components\Grid::make(12)->schema([
                            Select::make('last_education_id')
                                ->relationship(
                                    'lastEducation',
                                    'name',
                                    fn($query) => $query->orderBy('id')
                                )
                                ->searchable()
                                ->preload()
                                ->label('Pendidikan Terakhir')
                                ->required()
                                ->columnSpan(6),

                            TextInput::make('prefix_title')
                                ->label('Gelar Depan')
                                ->nullable()
                                ->columnSpan(3),

                            TextInput::make('suffix_title')
                                ->label('Gelar Belakang')
                                ->nullable()
                                ->columnSpan(3),
                        ]),

                        Forms\Components\Grid::make(12)->schema([
                            Select::make('employment_position_id')
                                ->relationship(
                                    'employmentPosition',
                                    'position_name',
                                    fn($query) => $query->orderBy('id')
                                )
                                ->searchable()
                                ->preload()
                                ->label('Jabatan')
                                ->required()
                                ->columnSpan(6),

                            Select::make('banjar_id')
                                ->relationship(
                                    'banjar',
                                    'banjar_name',
                                    fn($query) => $query->orderBy('id')
                                )
                                ->options(function () {
                                    return DB::table('ref_banjar')
                                        ->select(
                                            'id',
                                            DB::raw(
                                                'CONCAT("Br. ", banjar_name) as banjar_name'
                                            )
                                        )
                                        ->pluck('banjar_name', 'id');
                                })
                                ->searchable()
                                ->preload()
                                ->label('Alamat (Banjar)')
                                ->required()
                                ->columnSpan(3),

                            DatePicker::make('date_of_birth')
                                ->label('Tanggal Lahir')
                                ->required()
                                ->columnSpan(3),
                        ]),
                    ])
                    ->columnSpan(9),

                Forms\Components\Section::make('')
                    ->schema([
                        TextInput::make('att_pin')
                            ->label('PIN')
                            ->required()
                            ->helperText(
                                'PIN dapat diperoleh dari admin mesin absen.'
                            ),
                    ])
                    ->columnSpan(3),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name') // Displays employee's name
                    ->label('Nama'),

                Tables\Columns\TextColumn::make(
                    'employmentPosition.position_name'
                ) // Displays position_name
                    ->label('Jabatan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('banjar.banjar_name') // Displays banjar_name
                    ->label('Alamat')
                    ->searchable()
                    ->getStateUsing(
                        fn($record) => 'Br. ' . $record->banjar->banjar_name
                    ),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('banjar_id')
                    ->label('Banjar')
                    ->options(
                        fn() => DB::table('ref_banjar')->pluck(
                            'banjar_name',
                            'id'
                        )
                    )
                    ->searchable(),

                // Filter for employment_position_id
                Tables\Filters\SelectFilter::make('employment_position_id')
                    ->label('Jabatan')
                    ->options(
                        fn() => DB::table('ref_employment_position')->pluck(
                            'position_name',
                            'id'
                        )
                    )
                    ->searchable(),

                // Filter for last_education_id
                Tables\Filters\SelectFilter::make('last_education_id')
                    ->label('Pendidikan Terakhir')
                    ->options(
                        fn() => DB::table('ref_last_education')->pluck(
                            'name',
                            'id'
                        )
                    )
                    ->searchable(),
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

    public static function getRelations(): array
    {
        return [
                // Define relationships here
            ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGovEmployees::route('/'),
            'create' => Pages\CreateGovEmployee::route('/create'),
            'edit' => Pages\EditGovEmployee::route('/{record}/edit'),
        ];
    }
}
