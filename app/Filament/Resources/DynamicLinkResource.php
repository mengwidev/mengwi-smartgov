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
use Filament\Infolists;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Infolist;
use Filament\Tables\Filters\SelectFilter;
use Filament\Infolists\Components\Fieldset;

class DynamicLinkResource extends Resource
{
    protected static ?string $model = DynamicLink::class;
    protected static ?string $navigationGroup = 'Alat';
    protected static ?string $navigationIcon = 'heroicon-o-link';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('')->schema([
                TextInput::make('original_link')
                    ->label('Original Link')
                    ->required(),

                TextInput::make('custom_slug')
                    ->label('Custom Slug')
                    ->helperText('Maksimal 24 karakter')
                    ->maxLength(24)
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

                TextInput::make('notes')->label('Catatan'),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('original_link')
                    ->label('Original Link')
                    ->searchable()
                    ->formatStateUsing(
                        fn($state) => strlen($state) > 30
                            ? substr($state, 0, 30) . '...'
                            : $state
                    ),

                TextColumn::make('custom_slug')
                    ->label('Dynamic Link')
                    ->searchable()
                    ->formatStateUsing(function ($state) {
                        return config('app.url') . "/link/{$state}";
                    }),

                TextColumn::make('category.category_name')
                    ->label('Kategori')
                    ->badge()
                    ->color('info'),

                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'category_name'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->label(''),
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Action::make('download_qr')
                        ->label('Download QR')
                        ->url(
                            fn(DynamicLink $record) => route('qr.download', [
                                'id' => $record->id,
                            ])
                        )
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Infolists\Components\Section::make('Informasi Dynamic Link')
                ->icon('heroicon-o-information-circle')
                ->schema([
                    Grid::make(2)->schema([
                        Infolists\Components\TextEntry::make('original_link')
                            ->icon('heroicon-o-link')
                            ->copyable()
                            ->copyMessage('Link Asli Disalin!')
                            ->columnSpanFull(),
                        Infolists\Components\TextEntry::make('custom_slug')
                            ->label('Dynamic Link')
                            ->icon('heroicon-o-cog-6-tooth')
                            ->formatStateUsing(function ($state) {
                                return config('app.url') . "/link/{$state}";
                            }),
                        Infolists\Components\TextEntry::make(
                            'category.category_name'
                        )
                            ->icon('heroicon-o-tag')
                            ->label('Kategori')
                            ->badge()
                            ->color('info'),
                        Infolists\Components\TextEntry::make('notes')
                            ->icon('heroicon-o-pencil-square')
                            ->label('Catatan')
                            ->columnSpanFull(),
                    ]),
                ]),

            Infolists\Components\Section::make('QR Code')
                ->description('QR Code yang terintegrasi dengan Dynamic Link')
                ->icon('heroicon-o-qr-code')
                ->footerActions([
                    Infolists\Components\Actions\Action::make('download_qr')
                        ->label('Download QR')
                        ->url(
                            fn(DynamicLink $record) => route('qr.download', [
                                'id' => $record->id,
                            ])
                        )
                        ->color('success')
                        ->icon('heroicon-o-arrow-down-tray'),
                ])
                ->schema([
                    Grid::make(2)->schema([
                        Infolists\Components\ImageEntry::make(
                            'qr_code_filename'
                        )
                            ->disk('public')
                            ->label('')
                            ->url(
                                fn($record) => asset(
                                    'storage/' . $record->qr_code_filename
                                )
                            ),

                        Infolists\Components\TextEntry::make(
                            'qr_code_filename'
                        )->label('QR Code Filename'),
                    ]),
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
