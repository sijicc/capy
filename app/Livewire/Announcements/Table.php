<?php

namespace App\Livewire\Announcements;

use App\Models\Announcement;
use Exception;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

// TODO: Rename to AnnouncementsTable
class Table extends Component implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms;

    /**
     * @throws Exception
     */
    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('published_at')->badge()->color('gray')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('publish_at')->badge()->color('gray')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->badge()->color('gray')->sortable(),
                Tables\Columns\TextColumn::make('updated_at')->badge()->color('gray')->sortable(),
            ])
            ->query(fn() => Announcement::query())
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('show')
                        ->icon('heroicon-o-eye')
                        ->url(fn(Announcement $record): string => route('announcements.show', $record))
                        ->openUrlInNewTab(),
                    Tables\Actions\Action::make('publish')
                        ->icon('heroicon-o-envelope')
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
            ])
            ->filters([
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
            ]);
    }

    protected function shouldPersistTableFiltersInSession(): bool
    {
        return true;
    }
}
