<?php

namespace App\Filament\Resources\Domains\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DomainsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('registrar.name')
                    ->label('Registrar')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('hosting'),
                TextColumn::make('registration_date')
                    ->date('d-m-Y')
                    ->sortable(),
                TextColumn::make('expiry_date')
                    ->sortable()
                    ->formatStateUsing(function ($state) {
                        if (! $state) {
                            return '-';
                        }
                        $expiry = \Carbon\Carbon::parse($state);
                        $days = now()->diffInDays($expiry, false); // hasil integer

                        return $expiry->format('d-m-Y').' ('.(int) $days.' days)';
                    }),
                TextColumn::make('renewal_cost')
                    ->numeric()
                    ->money('IDR', locale: 'id')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Active' => 'success',
                        'Inactive' => 'danger',
                        default => 'primary',
                    })
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('status', direction: 'asc');
    }
}
