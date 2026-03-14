<?php

namespace App\Livewire\Contacts;

use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $contacts = Contact::where('company_id', Auth::user()->company_id)
            ->latest()
            ->get();

        return view('livewire.contacts.index', [
            'contacts' => $contacts,
        ])->layout('components.layouts.app', [
            'title' => 'Contatos',
        ]);
    }
}
