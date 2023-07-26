<?php

namespace App\Livewire\Roles;

use App\Policies\RolePolicy;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class RolesTable extends Component implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms;

    protected function table(Table $table): Table
    {
        $rolePolicy = new RolePolicy();

        return $table
            ->query(fn () => Role::query())
            ->columns([
                Tables\Columns\TextColumn::make('pretty_name')
                    ->sortable()
                    ->description(fn (Role $record) => $record->description)
                    ->label('Name')
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\Action::make('delete')
                    ->color('danger')
                    ->icon('heroicon-o-trash')
                    ->visible(fn (Role $record) => $rolePolicy->delete(auth()->user(), $record))
                    ->action(fn (Role $record) => $record->delete())
                    ->requiresConfirmation(),
                Tables\Actions\Action::make('edit')
                    ->color('primary')
                    ->icon('heroicon-o-pencil')
                    ->visible(fn (Role $record) => $rolePolicy->update(auth()->user(), $record))
                    ->url(fn (Role $record) => route('roles.edit', $record)),
            ]);
    }
}
