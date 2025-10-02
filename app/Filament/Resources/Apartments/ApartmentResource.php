<?php

namespace App\Filament\Resources\Apartments;

use App\Filament\Resources\Apartments\Pages\CreateApartment;
use App\Filament\Resources\Apartments\Pages\EditApartment;
use App\Filament\Resources\Apartments\Pages\ListApartments;
use App\Filament\Resources\Apartments\Schemas\ApartmentForm;
use App\Filament\Resources\Apartments\Tables\ApartmentsTable;
use App\Models\Apartment;
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

class ApartmentResource extends Resource
{
    protected static ?string $model = Apartment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Select::make('apartment_type_id')
                    ->preload()
                    ->required()
                    ->searchable()
                    ->relationship('apartment_type', 'name'),
                Select::make('property_id')
                    ->preload()
                    ->required()
                    ->searchable()
                    ->relationship('property', 'name'),
                TextInput::make('capacity_adults')
                    ->integer()
                    ->required()
                    ->minValue(0),
                TextInput::make('capacity_children')
                    ->integer()
                    ->required()
                    ->minValue(0),
                TextInput::make('size')
                    ->integer()
                    ->required()
                    ->minValue(0),
                TextInput::make('bathrooms')
                    ->integer()
                    ->required()
                    ->minValue(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('apartment_type.name'),
                TextColumn::make('property.name'),
                TextColumn::make('size'),
                TextColumn::make('bookings_avg_rating')
                    ->label('Rating')
                    ->placeholder(0)
                    ->avg('bookings', 'rating')
                    ->formatStateUsing(fn(?string $state): ?string => number_format($state, 2)),
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
            RelationManagers\PropertyRelationManager::class,
            RelationManagers\RoomsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListApartments::route('/'),
            'create' => CreateApartment::route('/create'),
            'edit' => EditApartment::route('/{record}/edit'),
        ];
    }
}
