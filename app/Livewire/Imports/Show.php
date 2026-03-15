<?php

namespace App\Livewire\Imports;

use App\Models\Import;
use App\Models\ImportRow;
use App\Services\ImportToContactsService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Show extends Component
{
    public Import $import;

    public string $filter = 'all';

    public function mount($id)
    {
        $this->import = Import::where('company_id', Auth::user()->company_id)
            ->findOrFail($id);
    }

    public function setFilter($status)
    {
        $this->filter = $status;
    }

    public function importValidRows(ImportToContactsService $service)
    {
        $count = $service->importValidRows($this->import);

        session()->flash(
            'success',
            "{$count} contatos foram importados com sucesso."
        );
    }

    public function render()
    {
        $query = ImportRow::where('import_id', $this->import->id);

        if ($this->filter !== 'all') {
            $query->where('status', $this->filter);
        }

        $rows = $query
            ->orderBy('row_number')
            ->paginate(50);

        return view('livewire.imports.show', [
            'rows' => $rows
        ])->layout('components.layouts.app', [
            'title' => 'Revisão da importação'
        ]);
    }
}
