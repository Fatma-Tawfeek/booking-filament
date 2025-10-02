<?php

namespace App\Filament\Resources\Apartments\RelationManagers;

use App\Rules\LatitudeRule;
use App\Rules\LongitudeRule;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PropertyRelationManager extends RelationManager
{
    protected static string $relationship = 'property';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('address_street')
                    ->required(),
                TextInput::make('address_postcode')
                    ->required(),
                Select::make('city_id')
                    ->relationship('city', 'name')
                    ->preload()
                    ->required()
                    ->searchable(),
                TextInput::make('lat')
                    ->required()
                    ->rules([new LatitudeRule()]),
                TextInput::make('long')
                    ->required()
                    ->rules([new LongitudeRule()]),
                Select::make('owner_id')
                    ->relationship('owner', 'name')
                    ->required()
                    ->searchable(),
                SpatieMediaLibraryFileUpload::make('photo')
                    ->image()
                    ->maxSize(5000)
                    ->multiple()
                    ->columnSpanFull()
                    ->collection('avatars')
                    ->conversion('thumbnail'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('owner.name'),
                TextColumn::make('address'),
                TextColumn::make('city.name'),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
