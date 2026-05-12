<?php

namespace App\Filament\Resources\DataAnaks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables;

class DataAnaksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Orang Tua')
                    ->searchable(),

                Tables\Columns\TextColumn::make('nama_anak')
                    ->label('Nama Anak')
                    ->searchable(),

                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->searchable(),

                Tables\Columns\TextColumn::make('umur_bulan')
                    ->label('Umur (Bulan)')
                    ->searchable(),

                Tables\Columns\TextColumn::make('tinggi_badan')
                    ->label('Tinggi Badan (cm)')
                    ->searchable(),

                Tables\Columns\TextColumn::make('berat_badan')
                    ->label('Berat Badan (kg)')
                    ->searchable(),

                Tables\Columns\TextColumn::make('hasilKalkulator.hasil_prediksi')
                    ->label('Hasil Prediksi')
                    ->wrap(),

                Tables\Columns\TextColumn::make('hasilKalkulator.penjelasan')
                    ->label('Penjelasan')
                    ->limit(150)
                    ->wrap(),

                Tables\Columns\TextColumn::make('hasilKalkulator.rekomendasi')
                    ->label('Rekomendasi')
                    ->limit(150)
                    ->wrap(),    
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
