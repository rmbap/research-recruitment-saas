<?php

namespace App\Livewire\Imports;

use App\Models\Import;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $imports = Import::where('company_id', Auth::user()->company_id)
            ->latest()
            ->get();

        return view('livewire.imports.index', [
            'imports' => $imports,
        ])->layout('components.layouts.app', [
            'title' => 'Importações',
        ]);
    }
}
