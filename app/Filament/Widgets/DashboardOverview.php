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
        // Domains
        $totalActiveDomains = Domain::where('status', 'active')
            ->where('expiry_date', '>', now()->addDays(30))
            ->count();

        $totalExpiringDomains = Domain::where('status', 'active')
            ->where('expiry_date', '<=', now()->addDays(30))
            ->count();

        $totalExpiringDomainsCost = Domain::where('status', 'active')
            ->where('expiry_date', '<=', now()->addDays(30))
            ->sum('renewal_cost');

        $totalExpiredDomains = Domain::where('status', 'inactive')->count();

        // Hostings
        $totalActiveHostings = Hosting::where('status', 'active')
            ->where('expiry_date', '>', now()->addDays(30))
            ->count();

        $totalExpiringHostings = Hosting::where('status', 'active')
            ->where('expiry_date', '<=', now()->addDays(30))
            ->count();

        $totalExpiringHostingsCost = Hosting::where('status', 'active')
            ->where('expiry_date', '<=', now()->addDays(30))
            ->sum('renewal_cost');

        $totalExpiredHostings = Hosting::where('status', 'inactive')->count();

        // VPS
        $totalActiveVps = Vps::where('status', 'active')
            ->where('expiry_date', '>', now()->addDays(30))
            ->count();

        $totalExpiringVps = Vps::where('status', 'active')
            ->where('expiry_date', '<=', now()->addDays(30))
            ->count();

        $totalExpiringVpsCost = Vps::where('status', 'active')
            ->where('expiry_date', '<=', now()->addDays(30))
            ->sum('renewal_cost');

        $totalExpiredVps = Vps::where('status', 'inactive')->count();

        return [
            // Domains
            Stat::make('Active Domains', number_format($totalActiveDomains))
                ->description('Currently active')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success')
                ->icon('heroicon-o-globe-alt'),

            Stat::make('Expiring Domains', number_format($totalExpiringDomains))
                ->description('Within 30 days – Est. Rp '.number_format($totalExpiringDomainsCost, 0, ',', '.'))
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
                ->description('Within 30 days – Est. Rp '.number_format($totalExpiringHostingsCost, 0, ',', '.'))
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
                ->description('Within 30 days – Est. Rp '.number_format($totalExpiringVpsCost, 0, ',', '.'))
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
