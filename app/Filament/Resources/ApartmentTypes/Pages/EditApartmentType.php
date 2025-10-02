<?php

namespace App\Filament\Resources\ApartmentTypes\Pages;

use App\Filament\Resources\ApartmentTypes\ApartmentTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditApartmentType extends EditRecord
{
    protected static string $resource = ApartmentTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
