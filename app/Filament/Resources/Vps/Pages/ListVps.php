<?php

namespace App\Filament\Resources\Vps\Pages;

use App\Filament\Resources\Vps\VpsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVps extends ListRecords
{
    protected static string $resource = VpsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
