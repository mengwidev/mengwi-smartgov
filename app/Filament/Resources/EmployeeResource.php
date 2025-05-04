<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EmployeeResource\RelationManagers\ContactsRelationManager;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'HR Management';
    protected static ?string $navigationLabel = 'Pegawai';

    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Grid::make(3)->schema([

                Forms\Components\Section::make()
                    ->columnSpan(2)
                    ->schema([
                        Forms\Components\Section::make('Nama dan Gelar')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Lengkap')
                                    ->helperText('Tanpa gelar depan/belakang dan sesuai KTP')
                                    ->required()
                                    ->maxLength(255),
                                Split::make([
                                    Forms\Components\TextInput::make('prefix_title')
                                        ->label('Gelar Depan')
                                        ->helperText('Masukkan gelar depan tanpa titik setelahnya (\'dr\' bukan \'dr.\') '),

                                    Forms\Components\TextInput::make('suffix_title')
                                        ->label('Gelar Belakang')
                                        ->helperText('Masukkan gelar belakang tanpa koma sebelumnya (\'S.Pd\' bukan \', S.Pd\')')

                                ])
                            ]),

                        Forms\Components\Section::make('Informasi Pribadi')
                            ->schema([
                                Split::make([
                                    Forms\Components\TextInput::make('birthplace')
                                        ->label('Tempat lahir')
                                        ->helperText('Masukkan tempat lahir sesuai di KTP')
                                        ->required(),

                                    Forms\Components\DatePicker::make('birthdate')
                                        ->label('Tanggal lahir')
                                        ->required()
                                ]),
                                Split::make([
                                    Forms\Components\Select::make('gender_id')
                                        ->label('Jenis Kelamin')
                                        ->options(\App\Models\Gender::orderBy('id')->pluck('name', 'id'))
                                        ->required(),

                                    Forms\Components\Select::make('banjar_id')
                                        ->label('Alamat (banjar)')
                                        ->options(\App\Models\Banjar::orderBy('id')->pluck('name', 'id'))
                                        ->required(),
                                ]),
                                Split::make([
                                    Forms\Components\Select::make('last_education_id')
                                        ->label('Pendidikan Terakhir')
                                        ->options(\App\Models\LastEducation::orderBy('id')->pluck('name', 'id'))
                                        ->required(),

                                    Forms\Components\Select::make('occupation_id')
                                        ->label('Jenis Pekerjaan di KTP')
                                        ->searchable()
                                        ->options(\App\Models\Occupation::orderBy('id')->pluck('name', 'id'))
                                        ->required(),
                                ]),
                                Split::make([
                                    Forms\Components\Select::make('religion_id')
                                        ->label('Agama')
                                        ->options(\App\Models\Religion::orderBy('id')->pluck('name', 'id'))
                                        ->required(),

                                    Forms\Components\Select::make('marital_status_id')
                                        ->label('Status Kawin')
                                        ->options(\App\Models\MaritalStatus::orderBy('id')->pluck('name', 'id'))
                                        ->required(),
                                ])
                            ]),

                        Forms\Components\Section::make('Informasi Kepegawaian')
                            ->schema([
                                Forms\Components\Select::make('employee_level_id')
                                    ->label('Jabatan')
                                    ->options(\App\Models\EmployeeLevel::orderBy('id')->pluck('name', 'id'))
                                    ->required(),

                                Forms\Components\Select::make('employment_unit_id')
                                    ->label('Unit Kerja')
                                    ->options(\App\Models\EmploymentUnit::orderBy('id')->pluck('name', 'id'))
                                    ->required(),

                                Forms\Components\TextInput::make('tipe_sk')
                                    ->label('Tipe SK')
                                    ->helperText('Gubernur Bali, Bupati Badung atau Perbekel Mengwi'),

                                Split::make([
                                    Forms\Components\TextInput::make('nomor_sk')
                                        ->label('Nomor SK'),

                                    Forms\Components\TextInput::make('tahun_sk')
                                        ->label('Tahun SK')
                                        ->helperText('Masukkan hanya tahunnya saja (contoh: 2021)')
                                        ->numeric()
                                        ->minValue(1900)
                                        ->maxValue(date('Y') + 1),
                                ]),

                                Forms\Components\DatePicker::make('sk_ditetapkan_pada')
                                    ->label('Tanggal SK Ditetapkan'),

                                Split::make([
                                    Forms\Components\DatePicker::make('mulai_menjabat')
                                        ->label('Tanggal Mulai Menjabat'),

                                    Forms\Components\DatePicker::make('akhir_menjabat')
                                        ->label('Tanggal Akhir Menjabat'),
                                ])
                            ])
                    ]),

                Forms\Components\Section::make()
                    ->columnSpan(1)
                    ->schema([
                        Forms\Components\FileUpload::make('photo')
                            ->label('Foto')
                            ->image()
                            ->directory('employee-photos')
                            ->imageEditor(true)
                            ->maxSize(2048)
                            ->required()
                            ->deleteUploadedFileUsing(fn($filePath) => \Illuminate\Support\Facades\Storage::disk('public')->delete($filePath)),
                    ]),
            ]),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Foto')
                    ->circular()
                    ->height(40),
                Tables\Columns\TextColumn::make('name')->searchable()->label('Nama'),
                Tables\Columns\TextColumn::make('banjar.name')->label('Banjar'),
                Tables\Columns\TextColumn::make('employeeLevel.name')->label('Jabatan'),
                Tables\Columns\TextColumn::make('employmentUnit.name')->label('Unit Kerja'),
            ])
            ->query(Employee::with('contacts'))
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

    public static function getRelations(): array
    {
        return [
            ContactsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
