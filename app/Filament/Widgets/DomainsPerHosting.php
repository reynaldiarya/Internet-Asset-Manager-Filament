<?php

namespace App\Filament\Widgets;

use App\Models\Domain;
use Filament\Widgets\ChartWidget;

class DomainsPerHosting extends ChartWidget
{
    protected ?string $heading = 'Domains Per Hosting';

    protected function getData(): array
    {
        $data = Domain::selectRaw('hosting, COUNT(*) as total')
            ->groupBy('hosting')
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
                    'label' => 'Domains per Hosting',
                    'data' => $data->pluck('total')->toArray(),
                    'backgroundColor' => $data->map(
                        fn ($d, $i) => $themeColors[$i % count($themeColors)]
                    )->toArray(),
                ],
            ],
            'labels' => $data->map(fn ($d) => $d->hosting ?? 'Unknown')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
