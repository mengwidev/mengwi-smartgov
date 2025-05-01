<?php

namespace App\Filament\Resources\EmployeeResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\ContactType;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Get;

class ContactsRelationManager extends RelationManager
{
    protected static string $relationship = 'contacts';
    protected static ?string $recordTitleAttribute = 'contactType.name';

    // Set the relation label within the form or table if needed
    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return 'Informasi Kontak'; // Your custom label
    }

    public function form(Form $form): Form
    {
        // Prepare helper map
        $helperMap = [
            'Email' => 'Masukkan alamat email, contoh: user@example.com',
            'Handphone' => 'Awali nomor dengan angka 0, contoh: 08123456789',
            'WhatsApp' => 'Awali nomor dengan angka 0, contoh: 08123456789',
            'Telegram' => 'Masukkan username Telegram, contoh: @yourusername',
            'Instagram' => 'Masukkan username Instagram, contoh: @yourusername',
            'Facebook' => 'Masukkan URL atau nama profil Facebook',
            'Website' => 'Masukkan URL lengkap, contoh: https://namasitus.com',
            'Blog' => 'Masukkan URL lengkap, contoh: https://namasitus.com',
            'LinkedIn' => 'Masukkan URL profil LinkedIn',
            'GitHub' => 'Masukkan username atau URL profil',
            'GitLab' => 'Masukkan username atau URL profil',
            'Bitbucket' => 'Masukkan username atau URL profil',
        ];

        // Preload contact types as [id => name]
        $contactTypes = ContactType::orderBy('id')->pluck('name', 'id');

        return $form->schema([
            Forms\Components\Select::make('contact_type_id')
                ->label('Jenis Kontak')
                ->options($contactTypes)
                ->searchable()
                ->required()
                ->reactive(),

            Forms\Components\TextInput::make('value')
                ->label('Informasi Kontak')
                ->required()
                ->maxLength(255)
                ->helperText(function (Get $get) use ($contactTypes, $helperMap) {
                    $typeName = $contactTypes[$get('contact_type_id')] ?? null;
                    return $helperMap[$typeName] ?? 'Masukkan informasi sesuai jenis kontak';
                }),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('contactType.name')
            ->columns([
                Tables\Columns\TextColumn::make('contactType.name')->label('Jenis Kontak'), // Change to Indonesian
                Tables\Columns\TextColumn::make('value')->label('Kontak'), // Change to Indonesian
            ])
            ->filters([
                // Filters can also be translated
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Kontak')
                    ->modalHeading('Tambah Kontak')
            ])
            ->actions([

                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Hapus Terpilih')
                ]),
            ]);
    }
}
