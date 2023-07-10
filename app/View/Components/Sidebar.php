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
                children: [
                    new MenuItem(
                        href: route('users.create'),
                        title: 'Create User',
                        active: request()->routeIs('users.create'),
                    ),
                ],
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
        ];
    }

    public function render(): View
    {
        return view('components.sidebar', [
            'menuItems' => $this->menuItems,
        ]);
    }
}
