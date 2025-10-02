<?php

namespace App\Filament\Resources\FacilityCategories;

use App\Filament\Resources\FacilityCategories\Pages\CreateFacilityCategory;
use App\Filament\Resources\FacilityCategories\Pages\EditFacilityCategory;
use App\Filament\Resources\FacilityCategories\Pages\ListFacilityCategories;
use App\Models\FacilityCategory;
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

class FacilityCategoryResource extends Resource
{
    protected static ?string $model = FacilityCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    protected static string | UnitEnum | null $navigationGroup = 'Facilities';

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
            RelationManagers\FacilitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFacilityCategories::route('/'),
            'create' => CreateFacilityCategory::route('/create'),
            'edit' => EditFacilityCategory::route('/{record}/edit'),
        ];
    }
}
