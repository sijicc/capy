<?php

namespace App\Livewire\Roles;

use Filament\Forms;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EditRole extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public Role $role;

    public $name;

    public $description;

    public $permissions = [];

    public function mount(): void
    {
        $this->form->fill([
            'name' => $this->role->pretty_name,
            'description' => $this->role->description,
            'permissions' => $this->role->permissions->pluck('id')->toArray(),
        ]);
    }

    public function submit(\App\Actions\EditRole $editRole): RedirectResponse|Redirector
    {
        $editRole->handle($this->role, [
            'name' => $this->name,
            'description' => $this->description,
            'permissions' => $this->permissions,
        ]);

        return redirect()->route('roles.index');
    }

    public function render(): View
    {
        return view('livewire.roles.edit-role');
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\Textarea::make('description'),
            Forms\Components\Fieldset::make('Permissions')
                ->schema([
                    ...$this->getPermissions(),
                ])->columns([
                    'sm' => 2,
                    'lg' => 3,
                    'xl' => 4,
                ]),
        ];
    }

    private function getPermissions(): array
    {
        $groups = Permission::all()->groupBy(fn($permission) => explode(':', $permission->name)[0]);
        $checkboxLists = [];
        foreach ($groups as $groupName => $group) {
            $checkboxLists[] = Forms\Components\CheckboxList::make('permissions')
                ->options($group->pluck('name', 'id')->toArray())
                ->label($groupName)
                ->bulkToggleable();
        }

        return $checkboxLists;
    }
}
