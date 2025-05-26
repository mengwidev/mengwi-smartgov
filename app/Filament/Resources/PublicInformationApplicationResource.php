<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PublicInformationApplicationResource\Pages;
use App\Filament\Resources\PublicInformationApplicationResource\RelationManagers;
use App\Filament\Resources\PublicInformationApplicationResource\RelationManagers\ApplicationHistoryRelationManager;

use App\Models\PublicInformationApplication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;

class PublicInformationApplicationResource extends Resource
{
    protected static ?string $model = PublicInformationApplication::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-left-end-on-rectangle';

    protected static ?string $navigationGroup = 'PPID';

    protected static ?string $navigationLabel = 'Permohonan Informasi Publik';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)->schema([
                    // LEFT SIDE - Main Data Section
                    Forms\Components\Section::make()
                        ->columnSpan(2)
                        ->schema([

                            // 1. Registration Info
                            Forms\Components\Section::make('Data Registrasi Permohonan')
                                ->icon('heroicon-o-arrow-right-end-on-rectangle')
                                ->schema([
                                    Forms\Components\Placeholder::make('Nomor Registrasi')
                                        ->label('Nomor Registrasi')
                                        ->content(fn($record) => $record?->reg_num ?? '-'),

                                    Forms\Components\Placeholder::make('Tanggal Pengajuan Permohonan')
                                        ->label('Tanggal Pengajuan Permohonan')
                                        ->content(fn($record) => $record?->created_at?->format('d M Y H:i') ?? '-'),

                                    Forms\Components\Placeholder::make('Metode Registrasi')
                                        ->label('Metode Registrasi')
                                        ->content(fn($record) => $record?->applicationMethod?->name ?? '-'),

                                    Forms\Components\Placeholder::make('Catatan Pemohon')
                                        ->label('Catatan Pemohon')
                                        ->content(fn($record) => $record?->note ?? '-'),
                                ]),

                            // 2. Applicant Info
                            Forms\Components\Section::make('Data Pemohon Informasi')
                                ->icon('heroicon-o-user')
                                ->schema([
                                    Forms\Components\Placeholder::make('Nama Pemohon')
                                        ->label('Nama Pemohon')
                                        ->content(fn($record) => $record?->applicant?->name ?? '-'),

                                    Forms\Components\Placeholder::make('Alamat Pemohon')
                                        ->label('Alamat Pemohon')
                                        ->content(fn($record) => $record?->applicant?->address ?? '-'),

                                    Forms\Components\Placeholder::make('Nomor Telepon')
                                        ->label('Nomor Telepon')
                                        ->content(fn($record) => $record?->applicant?->phone ?? '-'),

                                    Forms\Components\Placeholder::make('Email Pemohon')
                                        ->content(fn($record) => $record?->applicant?->email ?? '-'),

                                    Forms\Components\Placeholder::make('Nomor Identitas')
                                        ->content(
                                            fn($record) => ($record?->applicant?->identifierMethod?->name ?? '-') .
                                                ' - ' .
                                                ($record?->applicant?->applicant_identifier_value ?? '-')
                                        ),

                                    Forms\Components\Placeholder::make('applicant_identifier_attachment_download')
                                        ->label('Lampiran Identitas')
                                        ->content(function ($record) {
                                            if ($record?->applicant?->applicant_identifier_attachment) {
                                                $url = Storage::disk('public')->url($record->applicant->applicant_identifier_attachment);
                                                return new HtmlString(
                                                    '<a
                    href="' . $url . '"
                    target="_blank"
                    class="inline-flex items-center px-4 py-2 bg-primary-500 border border-transparent rounded-md font-semibold text-white text-sm hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150"
                >
                    Unduh Lampiran Identitas
                </a>'
                                                );
                                            }

                                            return new HtmlString('<span class="text-gray-500">-</span>');
                                        })
                                        ->columnSpanFull(),

                                ]),

                            // 3. Requested Info
                            Forms\Components\Section::make('Informasi Yang Dibutuhkan')
                                ->icon('heroicon-o-document-text')
                                ->schema([
                                    Forms\Components\Placeholder::make('Informasi Diminta')
                                        ->label('Informasi Diminta')
                                        ->content(fn($record) => $record?->information_requested ?? '-'),

                                    Forms\Components\Placeholder::make('Tujuan Permintaan')
                                        ->label('Tujuan Permintaan')
                                        ->content(fn($record) => $record?->information_purposes ?? '-'),

                                    Forms\Components\Placeholder::make('Metode Penerimaan')
                                        ->label('Metode Penerimaan')
                                        ->content(fn($record) => $record?->informationReceival?->name ?? '-'),

                                    Forms\Components\Placeholder::make('Metode Pengambilan Salinan')
                                        ->label('Metode Pengambilan Salinan')
                                        ->visible(fn($record) => $record?->is_get_copy)
                                        ->content(fn($record) => $record?->get_copy_method ?? '-'),
                                ]),
                        ]),

                    // RIGHT SIDE - Status & Docs
                    Forms\Components\Section::make()
                        ->columnSpan(1)
                        ->schema([

                            // 4. Application Status History
                            Forms\Components\Section::make('Data Status Permohonan')
                                ->icon('heroicon-o-arrow-path')
                                ->schema([
                                    Forms\Components\Placeholder::make('Status Terakhir')
                                        ->label('Status Terakhir')
                                        ->content(fn($record) => view('filament.components.status-badge', ['record' => $record])),


                                    Forms\Components\Placeholder::make('Tanggal Update Status')
                                        ->label('Tanggal Update Status')
                                        ->content(fn($record) => optional(
                                            $record->applicationHistory()->latest()->first()
                                        )->updated_at?->format('d M Y H:i') ?? '-'),

                                    Forms\Components\Placeholder::make('Catatan Status')
                                        ->label('Catatan Status')
                                        ->content(fn($record) => optional(
                                            $record->applicationHistory()->latest()->first()
                                        )->note ?? '-'),
                                ]),

                            // 5. Download Docs Placeholder
                            Forms\Components\Section::make('Unduh Dokumen')
                                ->icon('heroicon-o-folder-arrow-down')
                                ->schema([
                                    Forms\Components\Placeholder::make('Belum ada dokumen tersedia untuk diunduh.')
                                ]),
                        ])
                ])
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with([
                'applicant',
                'latestHistory.applicationStatus',
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('reg_num')
                    ->label('Nomor Registrasi'),

                TextColumn::make('applicant.name')
                    ->label('Nama Pemohon'),

                TextColumn::make('latest_status_label')
                    ->label('Status')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'Sedang Diproses', 'Permohonan Diajukan', 'Proses Verifikasi Pemohon', 'Informasi Terkirim' => 'info',
                        'Pemohon Keberatan' => 'warning',
                        'Permohonan Ditolak', 'Pemohon Mengajukan Sengketa' => 'danger',
                        'Permohonan Selesai' => 'success',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('latest_status_date_formatted') // <-- use the accessor name
                    ->label('Tanggal Status'),

                TextColumn::make('created_at')
                    ->label('Tanggal Registrasi')
                    ->dateTime('d M Y H:i'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Detail')->icon('heroicon-o-eye'),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [
            ApplicationHistoryRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPublicInformationApplications::route('/'),
            'create' => Pages\CreatePublicInformationApplication::route('/create'),
            'edit' => Pages\EditPublicInformationApplication::route('/{record}/edit'),
        ];
    }
}
