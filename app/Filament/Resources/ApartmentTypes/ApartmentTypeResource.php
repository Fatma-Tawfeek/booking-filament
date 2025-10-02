<?php

namespace App\Filament\Resources\ApartmentTypes;

use App\Filament\Resources\ApartmentTypes\Pages\CreateApartmentType;
use App\Filament\Resources\ApartmentTypes\Pages\EditApartmentType;
use App\Filament\Resources\ApartmentTypes\Pages\ListApartmentTypes;
use App\Filament\Resources\ApartmentTypes\Schemas\ApartmentTypeForm;
use App\Filament\Resources\ApartmentTypes\Tables\ApartmentTypesTable;
use App\Models\ApartmentType;
use BackedEnum;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class ApartmentTypeResource extends Resource
{
    protected static ?string $model = ApartmentType::class;

    protected static string | UnitEnum | null $navigationGroup = 'Facilities';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                DeleteBulkAction::make(),
            ]);
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
            'index' => ListApartmentTypes::route('/'),
            'create' => CreateApartmentType::route('/create'),
            'edit' => EditApartmentType::route('/{record}/edit'),
        ];
    }
}
