<?php

namespace App\Filament\Resources\Vps\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;
use Illuminate\Support\Facades\Crypt;

class VpsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('package_name')
                    ->maxLength(255)
                    ->required(),
                TextInput::make('server_ip')
                    ->rule('ip')
                    ->maxLength(255)
                    ->default(null),
                TextInput::make('username')
                    ->maxLength(255)
                    ->default(null),
                TextInput::make('password')
                    ->default(null)
                    ->maxLength(255)
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? Crypt::encryptString($state) : null)
                    ->afterStateHydrated(fn ($component, $state) => $component->state(filled($state) ? Crypt::decryptString($state) : null)
                    )
                    ->dehydrated(fn ($state) => filled($state)),
                TextInput::make('operating_system')
                    ->maxLength(255)
                    ->default(null),
                Select::make('provider_id')
                    ->relationship('provider', 'name')
                    ->preload()
                    ->searchable()
                    ->required(),
                DatePicker::make('purchase_date')
                    ->maxDate(now())
                    ->required(),
                DatePicker::make('expiry_date')
                    ->after('purchase_date')
                    ->required(),
                TextInput::make('renewal_cost')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->minValue(0)
                    ->maxValue(2147483647)
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->dehydrateStateUsing(fn ($state) => (int) str_replace([',', '.'], '', $state)),
                Select::make('status')
                    ->options(['Active' => 'Active', 'Inactive' => 'Inactive'])
                    ->default('Active')
                    ->required(),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
