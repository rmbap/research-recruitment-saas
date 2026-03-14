<?php

namespace App\Livewire\Imports;

use App\Models\Import;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $upload_file;

    public function saveImport(): void
    {
        $this->validate([
            'upload_file' => 'required|file|mimes:csv,xls,xlsx|max:10240',
        ], [
            'upload_file.required' => 'Selecione um arquivo para importar.',
            'upload_file.mimes' => 'O arquivo deve estar no formato CSV, XLS ou XLSX.',
            'upload_file.max' => 'O arquivo não pode ultrapassar 10MB.',
        ]);

        $file = $this->upload_file;

        $storedPath = $file->storeAs(
            'imports',
            now()->format('YmdHis') . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension(),
            'local'
        );

        Import::create([
            'company_id' => Auth::user()->company_id,
            'uploaded_by' => Auth::id(),
            'original_filename' => $file->getClientOriginalName(),
            'stored_filename' => $storedPath,
            'file_type' => $file->getClientOriginalExtension(),
            'status' => 'pending',
        ]);

        $this->reset('upload_file');

        session()->flash('success', 'Arquivo enviado com sucesso. O próximo passo será revisar o cabeçalho e mapear as colunas.');
    }

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
