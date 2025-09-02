<?php

namespace App\Filament\Resources\Registrars\Pages;

use App\Filament\Resources\Registrars\RegistrarResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRegistrar extends ViewRecord
{
    protected static string $resource = RegistrarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
