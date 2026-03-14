<?php

namespace App\Livewire\Organizations;

use App\Models\Organization;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $organizations = Organization::where('company_id', Auth::user()->company_id)
            ->latest()
            ->get();

        return view('livewire.organizations.index', [
            'organizations' => $organizations,
        ])->layout('components.layouts.app', [
            'title' => 'Organizations',
        ]);
    }
}
