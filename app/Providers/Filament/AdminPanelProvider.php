<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->profile()
            ->passwordReset()
            ->emailVerification()
            ->emailChangeVerification()
            // ->brandLogo(asset('logo.svg'))
            // ->darkModeBrandLogo(asset('logo.svg'))
            ->favicon(asset('favicon.ico'))
            ->colors([
                'primary' => [
                    50 => 'oklch(0.985 0 0)',
                    100 => 'oklch(0.967 0.001 286)',
                    200 => 'oklch(0.92 0.004 286)',
                    300 => 'oklch(0.871 0.006 286)',
                    400 => 'oklch(0.705 0.015 286)',
                    500 => 'oklch(0.274 0.006 286)',
                    600 => 'oklch(0.141 0.005 286)',
                    700 => 'oklch(0.21 0.006 286)',
                    800 => 'oklch(0.274 0.006 286)',
                    900 => 'oklch(0.21 0.006 286)',
                    950 => 'oklch(0.141 0.005 286)',
                ],
                'gray' => Color::Zinc,
                'danger' => Color::Rose,
                'info' => Color::Blue,
                'success' => Color::Green,
                'warning' => Color::Amber,
            ])
            ->font('DM Sans')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->plugins([])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
