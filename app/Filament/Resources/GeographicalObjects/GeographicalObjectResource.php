<?php

namespace App\Filament\Resources\GeographicalObjects;

use App\Filament\Resources\GeographicalObjects\Pages\CreateGeographicalObject;
use App\Filament\Resources\GeographicalObjects\Pages\EditGeographicalObject;
use App\Filament\Resources\GeographicalObjects\Pages\ListGeographicalObjects;
use App\Filament\Resources\GeographicalObjects\Schemas\GeographicalObjectForm;
use App\Filament\Resources\GeographicalObjects\Tables\GeographicalObjectsTable;
use App\Models\Geoobject;
use App\Rules\LatitudeRule;
use App\Rules\LongitudeRule;
use BackedEnum;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class GeographicalObjectResource extends Resource
{
    protected static ?string $model = Geoobject::class;

    protected static string | UnitEnum | null $navigationGroup = 'Geography';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('lat')
                    ->required()
                    ->rules([new LatitudeRule()]),
                TextInput::make('long')
                    ->required()
                    ->rules([new LongitudeRule()]),
                Select::make('city_id')
                    ->relationship('city', 'name')
                    ->preload()
                    ->required()
                    ->searchable()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('lat'),
                TextColumn::make('long'),
                TextColumn::make('city.name'),
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
            'index' => ListGeographicalObjects::route('/'),
            'create' => CreateGeographicalObject::route('/create'),
            'edit' => EditGeographicalObject::route('/{record}/edit'),
        ];
    }
}
