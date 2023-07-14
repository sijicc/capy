<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /** @var MenuItem[] */
    public array $menuItems;

    public function __construct()
    {
        $this->menuItems = [
            new MenuItem(
                href: route('dashboard'),
                title: 'Dashboard',
                icon: 'heroicon-m-home',
                active: request()->routeIs('dashboard'),
            ),
            new MenuItem(
                href: route('users.index'),
                title: 'Users',
                icon: 'heroicon-m-user-group',
                active: request()->routeIs('users.*'),
            ),
            new MenuItem(
                href: route('companies.index'),
                title: 'Companies',
                icon: 'heroicon-m-building-office',
                active: request()->routeIs('companies.*'),
            ),
            new MenuItem(
                href: route('invoices.index'),
                title: 'Invoices',
                icon: 'heroicon-m-credit-card',
                active: request()->routeIs('invoices.*'),
            ),
            new MenuItem(
                href: null,
                title: 'Tools',
                icon: 'heroicon-m-wrench',
                children: [
                    new MenuItem(
                        href: route('announcements.index'),
                        title: 'Announcements',
                        icon: 'heroicon-m-bell',
                        active: request()->routeIs('announcements.*'),
                    )
                ],
                active: false
            ),
            new MenuItem(
                href: null,
                title: 'Administration',
                icon: 'heroicon-m-shield-exclamation',
                children: [
                    new MenuItem(
                        href: route('roles.index'),
                        title: 'Roles',
                        icon: 'heroicon-m-check-badge',
                        active: request()->routeIs('roles.*'),
                    ),
                    new MenuItem(
                        href: route('settings.index'),
                        title: 'Settings',
                        icon: 'heroicon-m-cog-6-tooth',
                        active: request()->routeIs('settings.*'),
                    )
                ],
                active: false
            )
        ];
    }

    public function render(): View
    {
        return view('components.sidebar', [
            'menuItems' => $this->menuItems,
        ]);
    }
}
