<?php

namespace App\Actions;

use Spatie\Permission\Models\Role;
use Str;
use Validator;

class CreateRole
{
    public function handle(array $role): Role
    {
        $role['pretty_name'] = $role['name'];
        $role['name'] = Str::camel($role['name']);

        $validated = $this->validate($role);

        $role = Role::create($validated);
        $role->syncPermissions($validated['permissions']);

        return $role;
    }

    protected function validate(array $user): array
    {
        return Validator::make($user, [
            'name' => ['required', 'string', 'max:255', 'unique:roles,name'],
            'pretty_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'permissions' => ['array', 'nullable'],
        ])->validate();
    }
}
