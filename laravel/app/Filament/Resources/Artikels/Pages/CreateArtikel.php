<?php

namespace App\Filament\Resources\Artikels\Pages;

use App\Filament\Resources\Artikels\ArtikelResource;
use Filament\Resources\Pages\CreateRecord;

class CreateArtikel extends CreateRecord
{
    protected static string $resource = ArtikelResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['id_user'] = auth()->id();

        return $data;
    }
}
