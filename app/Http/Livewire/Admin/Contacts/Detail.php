<?php

namespace App\Http\Livewire\Admin\Contacts;

use App\Models\Contact;
use Livewire\Component;

class Detail extends Component
{
    public $contact;

    public function mount($id)
    {
        $this->contact = Contact::findOrFail($id);
    }

    public function render()
    {
        $this->contact->update([
            'readed_at' => now(),
        ]);

        return view('livewire.admin.contacts.detail')
            ->layout('layouts.admin');
    }
}
