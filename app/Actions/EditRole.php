<?php

namespace App\Actions;

use Spatie\Permission\Models\Role;
use Str;
use Validator;

class EditRole
{
    public function handle(Role $role, array $changes): Role
    {
        $changes['pretty_name'] = $changes['name'];
        $changes['name'] = Str::camel($changes['name']);

        $validated = $this->validate($changes, $role);

        $role->update($validated);
        $role->syncPermissions($validated['permissions']);

        return $role;
    }

    protected function validate(array $user, Role $role): array
    {
        return Validator::make($user, [
            'name' => ['required', 'string', 'max:255', 'unique:roles,name,' . $role->id],
            'pretty_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'permissions' => ['array', 'nullable'],
        ])->validate();
    }
}
