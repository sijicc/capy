<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use App\Policies\UserPolicy;
use Exception;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

// TODO: Rename to AnnouncementsTable
class UsersTable extends Component implements HasTable
{
    use InteractsWithTable;

    public function render(): View
    {
        return view('livewire.users.users-table');
    }

    protected function getTableQuery(): Builder
    {
        return User::query();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('id')->searchable()->sortable(),
            TextColumn::make('name')->searchable()->sortable(),
            TextColumn::make('email')->searchable()->sortable(),
            TextColumn::make('email_verified_at')->searchable()->sortable(),
            TextColumn::make('created_at')->searchable()->sortable(),
            TextColumn::make('updated_at')->searchable()->sortable(),
        ];
    }

    /**
     * @throws Exception
     */
    protected function getTableFilters(): array
    {
        return [

        ];
    }

    /**
     * @throws Exception
     */
    protected function getTableActions(): array
    {
        $userPolicy = new UserPolicy();
        return [
            ActionGroup::make([
                Action::make('view')
                    ->icon('heroicon-o-eye')
                    ->visible(fn(User $record): bool => $userPolicy->view(auth()->user(), $record))
                    ->url(fn(User $record): string => route('users.show', $record)),
                Action::make('edit')
                    ->icon('heroicon-o-pencil')
                    ->visible(fn(User $record): bool => $userPolicy->update(auth()->user(), $record))
                    ->url(fn(User $record): string => route('users.edit', $record)),
                Action::make('delete')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->visible(fn(User $record): bool => $userPolicy->delete(auth()->user(), $record))
                    ->action(fn(User $record): bool => $record->delete())
                    ->requiresConfirmation(),
            ])
        ];
    }

    protected function shouldPersistTableFiltersInSession(): bool
    {
        return true;
    }
}
