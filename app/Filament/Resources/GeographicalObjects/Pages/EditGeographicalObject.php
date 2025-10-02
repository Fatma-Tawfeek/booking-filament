<?php

namespace App\Filament\Resources\GeographicalObjects\Pages;

use App\Filament\Resources\GeographicalObjects\GeographicalObjectResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGeographicalObject extends EditRecord
{
    protected static string $resource = GeographicalObjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
