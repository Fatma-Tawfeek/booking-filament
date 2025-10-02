<?php

namespace App\Filament\Resources\GeographicalObjects\Pages;

use App\Filament\Resources\GeographicalObjects\GeographicalObjectResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGeographicalObjects extends ListRecords
{
    protected static string $resource = GeographicalObjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
