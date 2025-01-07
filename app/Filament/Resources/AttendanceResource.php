<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttendanceResource\Pages;
use App\Filament\Resources\AttendanceResource\RelationManagers;
use App\Models\Attendance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Imports\AttendanceImporter;
use App\Filament\Exports\AttendanceExporter;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ExportBulkAction;

class AttendanceResource extends Resource
{
    protected static ?string $model = Attendance::class;
    protected static ?string $navigationGroup = 'Kepegawaian';
    protected static ?string $navigationLabel = 'Log Presensi';
    protected static ?string $navigationIcon = 'heroicon-o-finger-print';

    public static function form(Form $form): Form
    {
        return $form->schema([
            //
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('month.name')->label('Bulan'),
                Tables\Columns\TextColumn::make('attType.name')->label(
                    'IN/OUT'
                ),
                Tables\Columns\TextColumn::make('employee.name')->label(
                    'Nama Pegawai'
                ),
                Tables\Columns\TextColumn::make('scan_date')->label(
                    'Tanggal Scan'
                ),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make()
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
                ExportBulkAction::make()->exporter(AttendanceExporter::class),
            ])
            ->headerActions([
                ImportAction::make()
                    ->importer(AttendanceImporter::class)
                    ->label('Import')
                    ->icon('heroicon-o-arrow-down-on-square-stack'),
                ExportAction::make()
                    ->exporter(AttendanceExporter::class)
                    ->label('Export')
                    ->icon('heroicon-o-arrow-up-on-square-stack'),
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
            'index' => Pages\ListAttendances::route('/'),
            // 'create' => Pages\CreateAttendance::route('/create'),
            // 'edit' => Pages\EditAttendance::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
