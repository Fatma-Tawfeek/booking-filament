<?php

namespace App\Filament\Resources\ApartmentTypes\Pages;

use App\Filament\Resources\ApartmentTypes\ApartmentTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListApartmentTypes extends ListRecords
{
    protected static string $resource = ApartmentTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
