<?php

namespace App\Livewire\Company;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class Setup extends Component
{
    public string $name = '';

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|min:2|max:255',
        ], [
            'name.required' => 'Informe o nome da empresa.',
            'name.min' => 'O nome da empresa deve ter pelo menos 2 caracteres.',
            'name.max' => 'O nome da empresa deve ter no máximo 255 caracteres.',
        ]);

        $baseSlug = Str::slug($this->name);
        $slug = $baseSlug;
        $counter = 1;

        while (Company::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $company = Company::create([
            'name' => $this->name,
            'slug' => $slug,
            'status' => 'active',
        ]);

        $user = Auth::user();
        $user->company_id = $company->id;
        $user->role = $user->role ?: 'tenant_admin';
        $user->status = $user->status ?: 'active';
        $user->save();

        session()->flash('success', 'Empresa criada com sucesso.');

        $this->redirectRoute('dashboard', navigate: true);
    }

    public function render()
    {
        return view('livewire.company.setup')
            ->layout('components.layouts.app', [
                'title' => 'Configurar empresa',
            ]);
    }
}
