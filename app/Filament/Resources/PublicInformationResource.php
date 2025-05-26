<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PublicInformationResource\Pages;
use App\Filament\Resources\PublicInformationResource\RelationManagers;
use App\Models\PublicInformation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class PublicInformationResource extends Resource
{
    protected static ?string $model = PublicInformation::class;
    protected static ?string $navigationGroup = 'PPID';
    protected static ?string $navigationLabel = 'Informasi Publik';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('information_classification_id')
                    ->relationship('informationClassification', 'name')
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Klasifikasi')
                            ->required(),

                        Forms\Components\TextInput::make('description')
                            ->label('Deskripsi Klasifikasi')
                            ->required(),
                    ])
                    ->required(),

                Forms\Components\Select::make('document_category_id')
                    ->label('Document Category')
                    ->relationship('documentCategory', 'name')
                    ->searchable()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->label('Kategori Dokumen')
                            ->required(),
                    ])
                    ->preload()
                    ->required(),

                Forms\Components\TextInput::make('summary')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('year')
                    ->required()
                    ->numeric()
                    ->minValue(2000)
                    ->maxValue(date('Y')) // limit up to current year
                    ->length(4),

                Forms\Components\FileUpload::make('filepath')
                    ->label('Upload Dokumen PDF')
                    ->directory('informasi-publik')
                    ->maxSize(2048)
                    ->acceptedFileTypes(['application/pdf'])
                    ->deleteUploadedFileUsing(fn($filePath) => Storage::disk('public')->delete($filePath))
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('informationClassification.name')
                    ->label('Klasifikasi')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('documentCategory.name')
                    ->label('Kategori Dokumen')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('summary')
                    ->label('Uraian')
                    ->limit(40)
                    ->searchable(),
                Tables\Columns\TextColumn::make('year')->label(label: 'Tahun'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Lihat Lampiran')
                    ->icon('heroicon-o-paper-clip')
                    ->url(fn($record) => Storage::disk('public')->url($record->filepath))
                    ->openUrlInNewTab()
                    ->visible(fn($record) => filled($record->filepath)),

                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->recordUrl(null)
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
            'index' => Pages\ListPublicInformation::route('/'),
            'create' => Pages\CreatePublicInformation::route('/create'),
            'edit' => Pages\EditPublicInformation::route('/{record}/edit'),
        ];
    }
}
