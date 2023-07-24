<?php

namespace App\Livewire\Companies;

use App\Exports\CompaniesExport;
use App\Models\Company;
use App\Policies\CompanyPolicy;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Table extends Component implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms;

    public function table(Tables\Table $table): Tables\Table
    {
        $companyPolicy = new CompanyPolicy();
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('nip')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('regon')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('website')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('created_at')->badge()->color('gray')->sortable(),
                Tables\Columns\TextColumn::make('updated_at')->badge()->color('gray')->sortable(),
            ])
            ->query(fn() => Company::query())
            ->actions([
                Tables\Actions\Action::make('delete')
                    ->color('danger')
                    ->icon('heroicon-o-trash')
                    ->visible(fn(Company $record) => $companyPolicy->delete(auth()->user(), $record))
                    ->action(fn(Company $record) => $record->delete())
                    ->requiresConfirmation(),
                Tables\Actions\Action::make('edit')
                    ->color('primary')
                    ->icon('heroicon-o-pencil')
                    ->visible(fn(Company $record) => $companyPolicy->update(auth()->user(), $record))
                    ->url(fn(Company $record) => route('roles.edit', $record)),
            ])
            ->bulkActions([
                Tables\Actions\BulkAction::make('delete')
                    ->action(fn(Collection $records) => $records->each(fn(Company $company) => $company->delete()))
                    ->deselectRecordsAfterCompletion()
                    ->requiresConfirmation(),
                Tables\Actions\BulkAction::make('export')
                    ->action(fn(Collection $records) => Excel::download(new CompaniesExport($records), 'companies.xlsx'))
                    ->deselectRecordsAfterCompletion()
                    ->requiresConfirmation(),
            ]);
    }
}
