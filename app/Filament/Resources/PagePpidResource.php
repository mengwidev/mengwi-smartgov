<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PagePpidResource\Pages;
use App\Filament\Resources\PagePpidResource\RelationManagers;
use App\Models\PagePpid;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class PagePpidResource extends Resource
{
    protected static ?string $model = PagePpid::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    protected static ?string $navigationGroup = 'PPID';

    protected static ?string $navigationLabel = 'Halaman Web PPID';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Halaman')
                ->description('Masukkan detail informasi halaman PPID yang akan diterbitkan.')
                ->icon('heroicon-o-document-text')
                ->schema([
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Halaman')
                            ->placeholder('Contoh: Transparansi Dana Desa')
                            ->required()
                            ->maxLength(255)
                            ->live(debounce: 500)
                            ->afterStateUpdated(function (callable $set, $state) {
                                $set('slug', Str::slug($state));
                            }),

                        Forms\Components\Placeholder::make('slug')
                            ->label('Slug URL')
                            ->content(fn($state) => $state ?? '-')
                            ->dehydrated()
                    ]),

                    Forms\Components\Select::make('page_ppid_category_id')
                        ->label('Kategori')
                        ->relationship('category', 'name')
                        ->preload(10)
                        ->createOptionForm([
                            Forms\Components\TextInput::make('name')
                                ->label('Nama Kategori')
                                ->required(),
                        ])
                        ->required(),
                ]),

            Forms\Components\Section::make('Konten & Lampiran')
                ->description('Isi konten halaman dan tambahkan lampiran jika diperlukan.')
                ->icon('heroicon-o-clipboard-document')
                ->schema([
                    Forms\Components\RichEditor::make('content')
                        ->label('Konten Halaman')
                        ->required()
                        ->columnSpanFull(),

                    Forms\Components\FileUpload::make('pdf_path')
                        ->label('Lampiran PDF (Opsional)')
                        ->disk('public')
                        ->directory('page-ppid/pdf')
                        ->acceptedFileTypes(['application/pdf'])
                        ->visibility('public'),
                ]),

            Forms\Components\Section::make('Gambar Utama')
                ->icon('heroicon-o-photo')
                ->description('Unggah gambar utama yang akan ditampilkan sebagai ilustrasi halaman.')
                ->schema([
                    Forms\Components\FileUpload::make('featured_image')
                        ->label('Gambar Utama')
                        ->image()
                        ->imageEditor()
                        ->disk('public')
                        ->directory('page-ppid/featured-images')
                        ->visibility('public')
                        ->maxSize(2048),
                ]),

            Forms\Components\Section::make('Status Publikasi')
                ->icon('heroicon-o-eye')
                ->schema([
                    Forms\Components\Toggle::make('is_published')
                        ->label('Publikasikan Sekarang?')
                        ->required(),
                ]),
        ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->limit(40),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug URL')
                    ->searchable()
                    ->limit(40),

                Tables\Columns\TextColumn::make('category.name') // relasi ke kategori
                    ->label('Kategori')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Publikasi')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
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
            'index' => Pages\ListPagePpids::route('/'),
            'create' => Pages\CreatePagePpid::route('/create'),
            'edit' => Pages\EditPagePpid::route('/{record}/edit'),
        ];
    }
}
