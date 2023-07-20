<?php

namespace App\Http\Livewire\Announcements;

use App\Models\Announcement;
use Exception;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

// TODO: Rename to AnnouncementsTable
class Table extends Component implements HasTable
{
    use InteractsWithTable;

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.announcements.table');
    }

    protected function getTableQuery(): Builder
    {
        return Announcement::query();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('id')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
            Tables\Columns\BadgeColumn::make('published_at')->searchable()->sortable(),
            Tables\Columns\BadgeColumn::make('publish_at')->sortable()->colors([
                'success',
                'secondary' => static fn($state): bool => $state > now(),
            ]),
            Tables\Columns\BadgeColumn::make('created_at')->sortable(),
            Tables\Columns\BadgeColumn::make('updated_at')->sortable(),
        ];
    }

    /**
     * @throws Exception
     */
    protected function getTableFilters(): array
    {
        return [
            Tables\Filters\Filter::make('should_notify')
                ->query(fn(Builder $query): Builder => $query->where('should_notify', true)),
            Tables\Filters\Filter::make('should_email')
                ->query(fn(Builder $query): Builder => $query->where('should_email', true)),
            Tables\Filters\Filter::make('published')
                ->query(fn(Builder $query): Builder => $query->published()),
            Tables\Filters\Filter::make('unpublished')
                ->query(fn(Builder $query): Builder => $query->unpublished()),
            Tables\Filters\Filter::make('published_at')
                ->form([
                    Forms\Components\DateTimePicker::make('published_from'),
                    Forms\Components\DateTimePicker::make('published_to'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['published_from'],
                            fn(Builder $query, $publishedFrom): Builder => $query->where('published_at', '>=', $publishedFrom)
                        )
                        ->when(
                            $data['published_to'],
                            fn(Builder $query, $publishedTo): Builder => $query->where('published_at', '<=', $publishedTo)
                        );
                }),
        ];
    }

    /**
     * @throws Exception
     */
    protected function getTableActions(): array
    {
        return [
            Tables\Actions\ActionGroup::make([
                Tables\Actions\Action::make('show')
                    ->icon('heroicon-o-eye')
                    ->url(fn(Announcement $record): string => route('announcements.show', $record))
                    ->openUrlInNewTab(),
                Tables\Actions\Action::make('publish')
                    ->icon('heroicon-o-mail')
                    ->action(function (Announcement $record) {
                        Notification::make()
                            ->title('Announcement published!')
                            ->success()
                            ->send();
                        $record->publish();
                    })
                    ->visible(fn(Announcement $record): bool => $record->isNotPublished())
                    ->requiresConfirmation(),
                Tables\Actions\Action::make('edit')
                    ->icon('heroicon-o-pencil')
                    ->url(fn(Announcement $record): string => route('announcements.edit', $record))
                    ->visible(fn(Announcement $record): bool => $record->isNotPublished()),
                Tables\Actions\Action::make('delete')
                    ->icon('heroicon-o-trash')
                    ->action(fn(Announcement $record): bool => $record->delete())
                    ->visible(fn(Announcement $record): bool => $record->isNotPublished())
                    ->requiresConfirmation(),
            ]),
        ];
    }

    protected function shouldPersistTableFiltersInSession(): bool
    {
        return true;
    }
}
