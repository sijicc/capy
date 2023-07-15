<?php

namespace App\Http\Livewire\Announcements;

use App\Models\Announcement;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Table extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

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

    protected function getTableFilters(): array
    {
        return [
            Tables\Filters\Filter::make('should_notify')
                ->query(fn(Builder $query): Builder => $query->where('should_notify', true)),
            Tables\Filters\Filter::make('should_email')
                ->query(fn(Builder $query): Builder => $query->where('should_email', true)),
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

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.announcements.table');
    }
}
