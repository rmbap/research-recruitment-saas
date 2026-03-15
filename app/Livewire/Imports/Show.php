<?php

namespace App\Livewire\Imports;

use App\Models\Import;
use App\Models\ImportRow;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Show extends Component
{
    public Import $import;

    public string $filter = 'all';

    public ?ImportRow $editingRow = null;

    public array $editingData = [];

    public function mount($id)
    {
        $this->import = Import::where('company_id', Auth::user()->company_id)
            ->findOrFail($id);
    }

    public function setFilter($status)
    {
        $this->filter = $status;
    }

    public function editRow($rowId)
    {
        $row = ImportRow::findOrFail($rowId);

        $this->editingRow = $row;
        $this->editingData = $row->raw_data ?? [];
    }

    public function saveRow()
    {
        if (!$this->editingRow) {
            return;
        }

        $this->editingRow->update([
            'raw_data' => $this->editingData,
            'status' => 'valid'
        ]);

        $this->editingRow = null;
        $this->editingData = [];
    }

    public function cancelEdit()
    {
        $this->editingRow = null;
        $this->editingData = [];
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
