<?php

use App\Models\Announcement;
use App\Models\Company;
use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Spatie\Permission\Models\Role;

Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard'));
});

Breadcrumbs::for('companies.index', function (BreadcrumbTrail $trail) {
    $trail->push('Companies', route('companies.index'));
});

Breadcrumbs::for('companies.create', function (BreadcrumbTrail $trail) {
    $trail->parent('companies.index');
    $trail->push('Create', route('companies.create'));
});

Breadcrumbs::for('companies.show', function (BreadcrumbTrail $trail, Company $company) {
    $trail->parent('companies.index');
    $trail->push($company->name, route('companies.show', $company));
});

Breadcrumbs::for('companies.edit', function (BreadcrumbTrail $trail, Company $company) {
    $trail->parent('companies.show', $company);
    $trail->push('Edit', route('companies.edit', $company));
});

Breadcrumbs::for('users.index', function (BreadcrumbTrail $trail) {
    $trail->push('Users', route('users.index'));
});

Breadcrumbs::for('users.create', function (BreadcrumbTrail $trail) {
    $trail->parent('users.index');
    $trail->push('Create', route('users.create'));
});

Breadcrumbs::for('users.show', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('users.index');
    $trail->push($user->name, route('users.show', $user));
});

Breadcrumbs::for('users.edit', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('users.show', $user);
    $trail->push('Edit', route('users.edit', $user));
});

Breadcrumbs::for('roles.index', function (BreadcrumbTrail $trail) {
    $trail->push('Roles', route('roles.index'));
});

Breadcrumbs::for('roles.create', function (BreadcrumbTrail $trail) {
    $trail->parent('roles.index');
    $trail->push('Create', route('roles.create'));
});

Breadcrumbs::for('roles.edit', function (BreadcrumbTrail $trail, Role $role) {
    $trail->parent('roles.index');
    $trail->push('Edit', route('roles.edit', $role));
});

Breadcrumbs::for('announcements.index', function (BreadcrumbTrail $trail) {
    $trail->push('Announcements', route('announcements.index'));
});

Breadcrumbs::for('announcements.create', function (BreadcrumbTrail $trail) {
    $trail->parent('announcements.index');
    $trail->push('Create', route('announcements.create'));
});

Breadcrumbs::for('announcements.show', function (BreadcrumbTrail $trail, Announcement $announcement) {
    $trail->parent('announcements.index');
    $trail->push($announcement->title, route('announcements.show', $announcement));
});

Breadcrumbs::for('announcements.edit', function (BreadcrumbTrail $trail, Announcement $announcement) {
    $trail->parent('announcements.show', $announcement);
    $trail->push('Edit', route('announcements.edit', $announcement));
});
