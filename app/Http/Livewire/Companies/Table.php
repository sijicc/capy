<?php

namespace App\Http\Livewire\Companies;

use App\Exports\CompaniesExport;
use App\Models\Company;
use Exception;
use Filament\Tables;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Table extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return Company::query();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('id')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('nip')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('regon')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('website')->searchable()->sortable(),
            Tables\Columns\BadgeColumn::make('created_at')->searchable()->sortable(),
            Tables\Columns\BadgeColumn::make('updated_at')->searchable()->sortable(),
        ];
    }

    /**
     * @throws Exception
     */
    protected function getTableBulkActions(): array
    {
        return [
            Tables\Actions\BulkAction::make('delete')
                ->action(fn (Collection $records) => $records->each(fn (Company $company) => $company->delete()))
                ->deselectRecordsAfterCompletion()
                ->requiresConfirmation(),
            Tables\Actions\BulkAction::make('export')
                ->action(fn (Collection $records) => Excel::download(new CompaniesExport($records), 'companies.xlsx'))
                ->deselectRecordsAfterCompletion()
                ->requiresConfirmation(),
        ];
    }

    public function render(): View
    {
        return view('livewire.companies.table');
    }
}
