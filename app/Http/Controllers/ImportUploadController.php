<?php

namespace App\Http\Controllers;

use App\Models\Import;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ImportUploadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'upload_file' => 'required|file|mimes:csv,xls,xlsx|max:10240',
        ], [
            'upload_file.required' => 'Selecione um arquivo para importar.',
            'upload_file.mimes' => 'O arquivo deve estar no formato CSV, XLS ou XLSX.',
            'upload_file.max' => 'O arquivo não pode ultrapassar 10MB.',
        ]);

        $file = $request->file('upload_file');

        $filename = now()->format('YmdHis') . '_' .
            Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) .
            '.' . $file->getClientOriginalExtension();

        $path = $file->storeAs('imports', $filename, 'local');

        Import::create([
            'company_id' => Auth::user()->company_id,
            'uploaded_by' => Auth::id(),
            'original_filename' => $file->getClientOriginalName(),
            'stored_filename' => $path,
            'file_type' => $file->getClientOriginalExtension(),
            'status' => 'pending',
        ]);

        return redirect()
            ->route('imports.index')
            ->with('success', 'Arquivo enviado com sucesso.');
    }
}
