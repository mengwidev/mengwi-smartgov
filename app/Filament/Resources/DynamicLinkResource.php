<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DynamicLinkResource\Pages;
use App\Filament\Resources\DynamicLinkResource\RelationManagers;
use App\Models\DynamicLink;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;

class DynamicLinkResource extends Resource
{
    protected static ?string $model = DynamicLink::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')
                    ->schema([
                        TextInput::make('original_link')
                            ->label('Original Link')
                            ->required(),

                        TextInput::make('custom_slug')
                            ->label('Custom Slug')
                            ->required(),

                        Select::make('category_id')
                            ->label('Kategori')
                            ->relationship('category', 'category_name')
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('category_name')
                                    ->label('Nama Kategori')
                                    ->required(),

                                TextInput::make('description')
                                    ->label('Deskripsi Kategori')
                                    ->required(),
                            ])
                            ->required(),

                        TextInput::make('notes')
                            ->label('Catatan')
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('original_link')
                    ->label('Original Link')
                    ->formatStateUsing(fn($state) => strlen($state) > 30 ? substr($state, 0, 30) . '...' : $state),

                TextColumn::make('custom_slug')
                    ->label('Slug'),

                TextColumn::make('category.category_name')
                    ->label('Kategori'),

                TextColumn::make('notes')
                    ->label('Catatan')
                    ->formatStateUsing(fn($state) => strlen($state) > 30 ? substr($state, 0, 30) . '...' : $state),

                TextColumn::make('created_at')
                    ->label('Dibuat Pada'),

                TextColumn::make('updated_at')
                    ->label('Diubah Pada'),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Action::make('download_qr')
                        ->label('Download QR')
                        ->url(fn(DynamicLink $record) => route('qr.download', ['id' => $record->id]))
                        ->color('success')
                        ->icon('heroicon-o-arrow-down-tray'),
                ]),
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
            'index' => Pages\ListDynamicLinks::route('/'),
            'create' => Pages\CreateDynamicLink::route('/create'),
            'edit' => Pages\EditDynamicLink::route('/{record}/edit'),
        ];
    }
}
