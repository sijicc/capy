<?php

namespace App\Http\Livewire\Roles;

use App\Policies\RolePolicy;
use Exception;
use Filament\Tables;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class RolesTable extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    public function getTableQuery(): Builder
    {
        return Role::query();
    }

    protected function getTableContentGrid(): ?array
    {
        return [
            'md' => 2,
            'xl' => 3,
        ];
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('pretty_name')
                ->sortable()
                ->description(fn(Role $record) => $record->description)
                ->label('Name')
                ->searchable(),
        ];
    }

    /**
     * @throws Exception
     */
    protected function getTableActions(): array
    {
        $rolePolicy = new RolePolicy();

        return [
            Tables\Actions\Action::make('delete')
                ->color('danger')
                ->icon('heroicon-o-trash')
                ->visible(fn(Role $record) => $rolePolicy->delete(auth()->user(), $record))
                ->action(fn(Role $record) => $record->delete())
                ->requiresConfirmation(),
            Tables\Actions\Action::make('edit')
                ->color('primary')
                ->icon('heroicon-o-pencil')
                ->visible(fn(Role $record) => $rolePolicy->update(auth()->user(), $record))
                ->url(fn(Role $record) => route('roles.edit', $record)),
        ];
    }

    public function render(): View
    {
        return view('livewire.roles.roles-table');
    }
}
