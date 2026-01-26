<?php

namespace App\Providers\Filament;

use App\Filament\Auth\UsernameLogin;
// use Doctrine\DBAL\Schema\View;
use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;
use Filament\FontProviders\GoogleFontProvider;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(UsernameLogin::class)
            ->breadcrumbs(false)
            ->brandName('Mengwi SmartGov')
            ->databaseNotifications()
            ->sidebarCollapsibleOnDesktop()
            ->sidebarWidth('18rem')
            ->colors([
                'primary' => Color::Sky,
                'rose' => Color::Rose,
                'indigo' => Color::Indigo,
                'orange' => Color::Orange,
                'amber' => Color::Amber,
                'yellow' => Color::Yellow,
                'lime' => Color::Lime,
                'green' => Color::Green,
                'emerald' => Color::Emerald,
                'teal' => Color::Teal,
                'cyan' => Color::Cyan,
                'blue' => Color::Blue,
                'violet' => Color::Violet,
                'purple' => Color::Purple,
                'fuchsia' => Color::Fuchsia,
                'pink' => Color::Pink,
                'slate' => Color::Slate,
                'gray' => Color::Gray,
                'zinc' => Color::Zinc,
                'neutral' => Color::Neutral,
                'Stone' => Color::Stone
            ])
            ->defaultThemeMode(ThemeMode::Light)
            ->font('Nunito Sans', provider: GoogleFontProvider::class)
            ->discoverResources(
                in: app_path('Filament/Resources'),
                for: 'App\\Filament\\Resources'
            )
            ->discoverPages(
                in: app_path('Filament/Pages'),
                for: 'App\\Filament\\Pages'
            )
            ->pages([Pages\Dashboard::class])
            ->discoverWidgets(
                in: app_path('Filament/Widgets'),
                for: 'App\\Filament\\Widgets'
            )
            ->widgets([
                Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
            ])
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
            ->authMiddleware([Authenticate::class])
            ->plugins([
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
                \Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin::make()
                    ->setIcon('heroicon-o-user')
                    ->shouldShowDeleteAccountForm(false)
                    ->shouldShowAvatarForm(
                        value: true,
                        directory: 'avatars',
                        rules: 'mimes:jpeg,png,bmp|max:2048'
                    )
                    ->setNavigationGroup('Pengaturan')
                    ->setTitle('Profil Saya')
                    ->setNavigationLabel('Profil Saya'),
            ])
            ->userMenuItems([
                'profile' => MenuItem::make()
                    ->label(fn() => auth()->user()->name)
                    ->url(fn(): string => EditProfilePage::getUrl())
                    ->icon('heroicon-o-user-circle'),
            ])
            ->viteTheme('resources/css/filament/admin/theme.css');
    }
}
