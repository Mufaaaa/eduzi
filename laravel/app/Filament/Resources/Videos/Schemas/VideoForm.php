<?php

namespace App\Filament\Resources\Videos\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;

class VideoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('judul')
                    ->label('Judul Video')
                    ->required(),
                Forms\Components\TextInput::make('url_video')
                    ->label('URL Video')
                    ->required(),
                Forms\Components\Textarea::make('deskripsi')
                    ->label('Deskripsi Video')
                    ->required(),
            ]);
    }
}
