<?php

namespace App\Filament\Resources\Komunitas\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;

class KomunitasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('isi')
                    ->label('Isi Komentar')
                    ->required(),
            ]);
    }
}
