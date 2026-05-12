<?php

namespace App\Filament\Resources\DataAnaks;

use App\Filament\Resources\DataAnaks\Pages\CreateDataAnak;
use App\Filament\Resources\DataAnaks\Pages\EditDataAnak;
use App\Filament\Resources\DataAnaks\Pages\ListDataAnaks;
use App\Filament\Resources\DataAnaks\Schemas\DataAnakForm;
use App\Filament\Resources\DataAnaks\Tables\DataAnaksTable;
use App\Models\DataAnak;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DataAnakResource extends Resource
{
    protected static ?string $model = DataAnak::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-face-smile';

    protected static UnitEnum|string|null $navigationGroup = 'Daftar Data Anak';

    protected static ?string $label = 'Data Anak';
    
    protected static ?string $pluralLabel = 'Data Anak';

    public static function form(Schema $schema): Schema
    {
        return DataAnakForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DataAnaksTable::configure($table);
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
            'index' => ListDataAnaks::route('/'),
            'create' => CreateDataAnak::route('/create'),
            'edit' => EditDataAnak::route('/{record}/edit'),
        ];
    }
}
