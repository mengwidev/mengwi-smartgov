<?php

namespace App\Filament\Resources\PublicInformationApplicationResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;

class ApplicationHistoryRelationManager extends RelationManager
{
    protected static string $relationship = 'applicationHistory';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('application_status_id')
                    ->label('Status Permohonan')
                    ->relationship('applicationStatus', 'name')
                    ->required(),

                Forms\Components\Textarea::make('note')
                    ->label('Catatan Status'),

                Forms\Components\DateTimePicker::make('updated_at')
                    ->label('Tanggal Update Status')
                    ->default(now())
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                BadgeColumn::make('applicationStatus.name')
                    ->label('Status')
                    ->color(fn($record) => $record->status_badge_color),
                TextColumn::make('note')
                    ->label('Catatan Status'),
                TextColumn::make('updated_at')
                    ->label('Tanggal Update Status')
                    ->dateTime('d M Y H:i'),
            ])
            ->defaultSort('updated_at', 'desc')
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
