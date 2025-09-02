<?php

namespace App\Filament\Resources\Vps\Pages;

use App\Filament\Resources\Vps\VpsResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewVps extends ViewRecord
{
    protected static string $resource = VpsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
