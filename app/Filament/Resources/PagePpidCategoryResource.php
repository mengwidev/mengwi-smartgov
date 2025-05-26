<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PagePpidCategoryResource\Pages;
use App\Filament\Resources\PagePpidCategoryResource\RelationManagers;
use App\Models\PagePpidCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PagePpidCategoryResource extends Resource
{
    protected static ?string $model = PagePpidCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'PPID';

    protected static ?string $navigationParentItem = 'Halaman Web PPID';

    protected static ?string $navigationLabel = 'Kategori';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\TextInput::make('name')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPagePpidCategories::route('/'),
            'create' => Pages\CreatePagePpidCategory::route('/create'),
            'edit' => Pages\EditPagePpidCategory::route('/{record}/edit'),
        ];
    }
}
