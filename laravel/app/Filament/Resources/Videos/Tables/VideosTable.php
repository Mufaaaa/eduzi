<?php

namespace App\Filament\Resources\Videos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables;

class VideosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul Video')
                    ->searchable(),

                Tables\Columns\TextColumn::make('url_video')
                    ->label('URL Video')
                    ->searchable(),

                Tables\Columns\TextColumn::make('deskripsi')
                    ->label('Deskripsi Video')
                    ->searchable(),
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
