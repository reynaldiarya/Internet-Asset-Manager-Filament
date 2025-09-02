<?php

namespace App\Filament\Resources\Domains\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;

class DomainForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Select::make('registrar_id')
                    ->relationship('registrar', 'name')
                    ->preload()
                    ->searchable()
                    ->required(),
                Select::make('hosting')
                    ->options([
                        '-' => '-',
                        'Shared Hosting' => 'Shared hosting',
                        'Cloud Hosting' => 'Cloud hosting',
                        'WordPress Hosting' => 'WordPress hosting',
                        'Unlimited Hosting' => 'Unlimited hosting',
                        'VPS' => 'VPS',
                        'Dedicated Server' => 'Dedicated server',
                    ])
                    ->default('-')
                    ->required(),
                DatePicker::make('registration_date')
                    ->required(),
                DatePicker::make('expiry_date')
                    ->required(),
                TextInput::make('renewal_cost')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->minValue(0)
                    ->maxValue(2147483647)
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(','),
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
