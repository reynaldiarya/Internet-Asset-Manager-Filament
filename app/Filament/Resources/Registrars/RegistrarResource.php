<?php

namespace App\Filament\Resources\Registrars;

use App\Filament\Resources\Registrars\Pages\CreateRegistrar;
use App\Filament\Resources\Registrars\Pages\EditRegistrar;
use App\Filament\Resources\Registrars\Pages\ListRegistrars;
use App\Filament\Resources\Registrars\Pages\ViewRegistrar;
use App\Filament\Resources\Registrars\Schemas\RegistrarForm;
use App\Filament\Resources\Registrars\Schemas\RegistrarInfolist;
use App\Filament\Resources\Registrars\Tables\RegistrarsTable;
use App\Models\Registrar;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class RegistrarResource extends Resource
{
    protected static ?string $model = Registrar::class;

    protected static ?string $title = 'Registrar';

    protected static ?string $navigationLabel = 'Registrar';

    protected static string|UnitEnum|null $navigationGroup = 'Master';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentCheck;

    protected static ?string $recordTitleAttribute = 'Registrar';

    public static function form(Schema $schema): Schema
    {
        return RegistrarForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RegistrarInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RegistrarsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRegistrars::route('/'),
            'create' => CreateRegistrar::route('/create'),
            'view' => ViewRegistrar::route('/{record}'),
            'edit' => EditRegistrar::route('/{record}/edit'),
        ];
    }
}
