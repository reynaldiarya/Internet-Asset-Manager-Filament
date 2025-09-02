<?php

namespace App\Filament\Widgets;

use App\Models\Domain;
use App\Models\Hosting;
use App\Models\Vps;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalActiveDomains = Domain::where('status', 'active')
            ->where('expiry_date', '>', now()->addDays(30))
            ->count();
        $totalExpiringDomains = Domain::where('status', 'active')
            ->where('expiry_date', '<=', now()->addDays(30))
            ->count();
        $totalExpiredDomains = Domain::where('status', 'inactive')->count();

        $totalActiveHostings = Hosting::where('status', 'active')
            ->where('expiry_date', '>', now()->addDays(30))
            ->count();
        $totalExpiringHostings = Hosting::where('status', 'active')
            ->where('expiry_date', '<=', now()->addDays(30))
            ->count();
        $totalExpiredHostings = Hosting::where('status', 'inactive')->count();

        $totalActiveVps = Vps::where('status', 'active')
            ->where('expiry_date', '>', now()->addDays(30))
            ->count();
        $totalExpiringVps = Vps::where('status', 'active')
            ->where('expiry_date', '<=', now()->addDays(30))
            ->count();
        $totalExpiredVps = Vps::where('status', 'inactive')->count();

        return [
            // Domains
            Stat::make('Active Domains', number_format($totalActiveDomains))
                ->description('Currently active')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success')
                ->icon('heroicon-o-globe-alt'),

            Stat::make('Expiring Domains', number_format($totalExpiringDomains))
                ->description('Expiring within 30 days')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning')
                ->icon('heroicon-o-exclamation-circle'),

            Stat::make('Expired Domains', number_format($totalExpiredDomains))
                ->description('Already expired')
                ->descriptionIcon('heroicon-o-x-circle')
                ->color('danger')
                ->icon('heroicon-o-x-circle'),

            // Hostings
            Stat::make('Active Hostings', number_format($totalActiveHostings))
                ->description('Currently active')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success')
                ->icon('heroicon-o-server'),

            Stat::make('Expiring Hostings', number_format($totalExpiringHostings))
                ->description('Expiring within 30 days')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning')
                ->icon('heroicon-o-exclamation-circle'),

            Stat::make('Expired Hostings', number_format($totalExpiredHostings))
                ->description('Already expired')
                ->descriptionIcon('heroicon-o-x-circle')
                ->color('danger')
                ->icon('heroicon-o-x-circle'),

            // VPS
            Stat::make('Active VPS', number_format($totalActiveVps))
                ->description('Currently active')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success')
                ->icon('heroicon-o-server-stack'),

            Stat::make('Expiring VPS', number_format($totalExpiringVps))
                ->description('Expiring soon')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning')
                ->icon('heroicon-o-exclamation-triangle'),

            Stat::make('Expired VPS', number_format($totalExpiredVps))
                ->description('Already expired')
                ->descriptionIcon('heroicon-o-x-circle')
                ->color('danger')
                ->icon('heroicon-o-x-circle'),
        ];
    }
}
