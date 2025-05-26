<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfilPpidResource\Pages;
use App\Filament\Resources\ProfilPpidResource\RelationManagers;
use App\Models\Employee;
use App\Models\ProfilPpid;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;

class ProfilPpidResource extends Resource
{
    protected static ?string $model = ProfilPpid::class;
    protected static ?string $navigationGroup = 'PPID';
    protected static ?string $navigationLabel = 'Profil PPID';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('employee_id')
                    ->label(label: 'Petugas/Pejabat')
                    ->options(\App\Models\Employee::orderBy('id', 'asc')->pluck('name', 'id'))
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('role_id')
                    ->label('Kedudukan Dalam PPID')
                    ->options(\App\Models\KedudukanPpid::orderBy('id', 'asc')->pluck('name', 'id'))
                    ->preload()
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('employee.photo')
                    ->label('')
                    ->circular()
                    ->height(40),
                Tables\Columns\TextColumn::make('employee.name')
                    ->label('Petugas/Pejabat')
                    ->formatStateUsing(
                        fn($state, $record): string =>
                        trim(
                            ($record->employee->prefix_title ? $record->employee->prefix_title . '. ' : '') .
                                $record->employee->name .
                                ($record->employee->suffix_title ? ', ' . $record->employee->suffix_title : '')
                        )
                    )
                    ->description(function ($record): string {
                        $level = $record->employee->employeeLevel->name;
                        $unit = $record->employee->employmentUnit->name;

                        $unitDisplay = in_array(strtolower($unit), ['perbekel', 'sekretaris desa']) ? 'Mengwi' : $unit;

                        return "{$level} {$unitDisplay}";
                    }),
                Tables\Columns\TextColumn::make('role.name')
                    ->label('Kedudukan Dalam PPID')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListProfilPpids::route('/'),
            'create' => Pages\CreateProfilPpid::route('/create'),
            'edit' => Pages\EditProfilPpid::route('/{record}/edit'),
        ];
    }
}
