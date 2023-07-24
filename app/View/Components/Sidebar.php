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
                icon: 'heroicon-s-home',
                active: request()->routeIs('dashboard'),
            ),
            new MenuItem(
                href: route('users.index'),
                title: 'Users',
                icon: 'heroicon-s-user-group',
                active: request()->routeIs('users.*'),
            ),
            new MenuItem(
                href: route('companies.index'),
                title: 'Companies',
                icon: 'heroicon-m-building-office',
                active: request()->routeIs('companies.*'),
            ),
            new MenuItem(
                href: null,
                title: 'Tools',
                icon: 'heroicon-s-beaker',
                children: [
                    new MenuItem(
                        href: route('announcements.index'),
                        title: 'Announcements',
                        icon: 'heroicon-s-bell',
                        active: request()->routeIs('announcements.*'),
                    ),
                ],
                active: false
            ),
            new MenuItem(
                href: null,
                title: 'Administration',
                icon: 'heroicon-s-shield-exclamation',
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
                        icon: 'heroicon-s-cog',
                        active: request()->routeIs('settings.*'),
                    ),
                ],
                active: false
            ),
        ];
    }

    public function render(): View
    {
        return view('components.sidebar', [
            'menuItems' => $this->menuItems,
        ]);
    }
}
