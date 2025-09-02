<?php

namespace App\Filament\Widgets;

use App\Models\Domain;
use Filament\Widgets\ChartWidget;

class DomainsPerRegistrar extends ChartWidget
{
    protected ?string $heading = 'Domains Per Registrar';

    protected function getData(): array
    {
        $data = Domain::with('registrar')
            ->selectRaw('registrar_id, COUNT(*) as total')
            ->groupBy('registrar_id')
            ->get();

        $themeColors = [
            '#3B82F6', // primary (blue-500)
            '#10B981', // success (green-500)
            '#F59E0B', // warning (amber-500)
            '#EF4444', // danger (red-500)
            '#06B6D4', // info (cyan-500)
            '#8B5CF6', // purple-500
            '#EC4899', // pink-500
            '#6B7280', // gray-500
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Domains per Registrar',
                    'data' => $data->pluck('total')->toArray(),
                    'backgroundColor' => $themeColors,
                ],
            ],
            'labels' => $data->map(fn ($d) => $d->registrar->name ?? 'Unknown')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
