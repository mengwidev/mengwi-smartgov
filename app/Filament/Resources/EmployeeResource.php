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
                Forms\Components\Section::make()
                    ->columnSpan(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->helperText('Tanpa gelar depan/belakang dan sesuai KTP')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Select::make('banjar_id')
                            ->label('Banjar')
                            ->options(\App\Models\Banjar::orderBy('id')->pluck('name', 'id'))
                            ->required(),

                        Forms\Components\Select::make('employment_unit_id')
                            ->options(\App\Models\EmploymentUnit::orderBy('id')->pluck('name', 'id'))
                            ->label('Unit Kerja')
                            ->required(),

                        Forms\Components\Select::make('employee_level_id')
                            ->label('Jabatan')
                            ->options(\App\Models\EmployeeLevel::orderBy('id')->pluck('name', 'id'))
                            ->required(),
                    ])
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
                Tables\Columns\TextColumn::make('level.name')->label('Jabatan'),
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
