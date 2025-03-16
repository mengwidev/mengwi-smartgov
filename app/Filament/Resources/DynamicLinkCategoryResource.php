<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DynamicLinkCategoryResource\Pages;
use App\Models\DynamicLinkCategory;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DynamicLinkCategoryResource extends Resource
{
    protected static ?string $model = DynamicLinkCategory::class;

    protected static ?string $navigationGroup = 'Alat';

    protected static ?string $navigationParentItem = 'Dynamic Link';

    protected static ?string $navigationLabel = 'Kategori';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make([
                TextInput::make('category_name')
                    ->label('Nama Kategori')
                    ->required(),

                RichEditor::make('description')->label('Deskripsi')->required(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('category_name')->label('Nama Kategori'),
                TextColumn::make('description')->label('Deskripsi'),
            ])
            ->filters([
                //
            ])
            ->actions([Tables\Actions\EditAction::make()])
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
            'index' => Pages\ListDynamicLinkCategories::route('/'),
            'create' => Pages\CreateDynamicLinkCategory::route('/create'),
            'edit' => Pages\EditDynamicLinkCategory::route('/{record}/edit'),
        ];
    }
}
