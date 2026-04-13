<?php

namespace App\Filament\Resources\Artikels\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;

class ArtikelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Forms\Components\TextInput::make('kategori')
                        ->label('Kategori')
                        ->required(),

                Forms\Components\TextInput::make('judul')
                    ->label('Judul Artikel')
                    ->required(),

                Forms\Components\RichEditor::make('isi')
                    ->label('Isi Artikel')
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'bulletList',
                        'orderedList',
                        'link',
                        'redo',
                        'undo',
                    ])
                    ->required(),
                    
                Forms\Components\FileUpload::make('gambar')
                    ->label('Foto Artikel')
                    ->image() // hanya boleh gambar
                    ->disk('public')
                    ->directory('Artikels') // folder penyimpanan di storage/app/public/doctors
                    ->maxSize(5000)
                    ->visibility('public')
                    ->preserveFilenames()
                    ->required(),

            ]);
    }
}
