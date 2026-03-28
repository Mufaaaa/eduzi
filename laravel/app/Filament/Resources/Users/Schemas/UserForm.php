<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;
use Illuminate\Support\Facades\Auth;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Pengguna')
                    ->required(),

                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->required(),
            ]);
    }
}
