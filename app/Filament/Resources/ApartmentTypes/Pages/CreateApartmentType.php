<?php

namespace App\Filament\Resources\ApartmentTypes\Pages;

use App\Filament\Resources\ApartmentTypes\ApartmentTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateApartmentType extends CreateRecord
{
    protected static string $resource = ApartmentTypeResource::class;
}
