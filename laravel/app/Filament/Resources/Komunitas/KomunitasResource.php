<?php

namespace App\Filament\Resources\Komunitas;

use App\Filament\Resources\Komunitas\Pages\CreateKomunitas;
use App\Filament\Resources\Komunitas\Pages\EditKomunitas;
use App\Filament\Resources\Komunitas\Pages\ListKomunitas;
use App\Filament\Resources\Komunitas\Schemas\KomunitasForm;
use App\Filament\Resources\Komunitas\Tables\KomunitasTable;
use App\Models\Komunitas;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class KomunitasResource extends Resource
{
    protected static ?string $model = Komunitas::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-group';

    protected static UnitEnum|string|null $navigationGroup = 'Komunitas';

    protected static ?string $label = 'Komunitas';
    
    protected static ?string $pluralLabel = 'Komunitas';

    public static function form(Schema $schema): Schema
    {
        return KomunitasForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KomunitasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListKomunitas::route('/'),
            'create' => CreateKomunitas::route('/create'),
            'edit' => EditKomunitas::route('/{record}/edit'),
        ];
    }
}
