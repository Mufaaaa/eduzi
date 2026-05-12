<?php

namespace App\Filament\Resources\DataAnaks\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;

class DataAnakForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Select::make('id_user')
                    ->label('Nama Orang Tua')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),

                forms\Components\TextInput::make('nama_anak')
                    ->label('Nama Anak')
                    ->required(),
                    
                Forms\Components\Select::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->options([
                        'Laki-laki' => 'Laki-laki',
                        'Perempuan' => 'Perempuan',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('umur_bulan')
                    ->label('Umur (Bulan)')
                    ->numeric()
                    ->required(),   

                Forms\Components\TextInput::make('tinggi_badan')
                    ->label('Tinggi Badan (cm)')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('berat_badan')
                    ->label('Berat Badan (kg)')
                    ->numeric() 
                    ->required(),

                Forms\Components\Placeholder::make('hasil_prediksi')
                    ->label('Hasil Prediksi')
                    ->content(fn ($record) => 
                        $record?->hasilKalkulator?->hasil_prediksi ?? '-'
                    ),

                Forms\Components\Placeholder::make('penjelasan')
                    ->label('Penjelasan')
                    ->content(fn ($record) => 
                        $record?->hasilKalkulator?->penjelasan ?? '-'
                    ),

                Forms\Components\Placeholder::make('rekomendasi')
                    ->label('Rekomendasi')
                    ->content(fn ($record) => 
                        $record?->hasilKalkulator?->rekomendasi ?? '-'
                    ),

            ]);
    }
}
