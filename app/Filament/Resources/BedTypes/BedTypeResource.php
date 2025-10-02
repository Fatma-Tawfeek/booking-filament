<?php

namespace App\Filament\Resources\BedTypes;

use App\Filament\Resources\BedTypes\Pages\CreateBedType;
use App\Filament\Resources\BedTypes\Pages\EditBedType;
use App\Filament\Resources\BedTypes\Pages\ListBedTypes;
use App\Filament\Resources\BedTypes\Schemas\BedTypeForm;
use App\Filament\Resources\BedTypes\Tables\BedTypesTable;
use App\Models\BedType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BedTypeResource extends Resource
{
    protected static ?string $model = BedType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return BedTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BedTypesTable::configure($table);
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
            'index' => ListBedTypes::route('/'),
            'create' => CreateBedType::route('/create'),
            'edit' => EditBedType::route('/{record}/edit'),
        ];
    }
}
