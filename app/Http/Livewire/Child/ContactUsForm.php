<?php

namespace App\Http\Livewire\Child;

use App\Models\Contact;
use Livewire\Component;

class ContactUsForm extends Component
{
    public $name;
    public $email;
    public $subject;
    public $message;

    public function submit()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        Contact::create([
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'body' => $this->message,
            'registered' => auth()->check(),
        ]);

        $this->reset(['name', 'email', 'subject', 'message']);

        session()->flash('success_msg', "Thanks for your response.");
    }

    public function mount()
    {
        if (auth()->check()) {
            $this->name = auth()->user()->name;
            $this->email = auth()->user()->email;
        }
    }

    public function render()
    {
        return view('livewire.child.contact-us-form');
    }
}
