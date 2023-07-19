<?php

namespace App\Http\Livewire\Roles;

use Filament\Forms;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;
use Livewire\Redirector;
use Spatie\Permission\Models\Permission;

class CreateRole extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public $name;
    public $description;
    public $permissions = [];

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

    public function submit(\App\Actions\CreateRole $createRole): RedirectResponse|Redirector
    {
        $createRole->handle([
            'name' => $this->name,
            'description' => $this->description,
            'permissions' => $this->permissions,
        ]);

        return redirect()->route('roles.index');
    }

    public function render(): View
    {
        return view('livewire.roles.create-role');
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
