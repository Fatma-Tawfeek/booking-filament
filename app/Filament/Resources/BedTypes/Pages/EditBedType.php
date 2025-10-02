<?php

namespace App\Filament\Resources\BedTypes\Pages;

use App\Filament\Resources\BedTypes\BedTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBedType extends EditRecord
{
    protected static string $resource = BedTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
