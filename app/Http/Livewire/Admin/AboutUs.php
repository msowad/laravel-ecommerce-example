<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class AboutUs extends Component
{
    public $body;

    public function dehydrate()
    {
        $this->emit('setEditor');
    }

    public function submit()
    {
        if (!can('manage about us')) {
            return;
        }

        $this->validate(['body' => 'required']);
        $aboutUs = \App\Models\AboutsUs::first();

        if ($aboutUs) {
            $aboutUs->update(['body' => $this->body]);
        } else {
            \App\Models\AboutsUs::create(['body' => $this->body]);
        }

        session()->flash('success_msg', 'Saved');
    }

    public function mount()
    {
        $this->body = \App\Models\AboutsUs::first()->body;
    }

    public function render()
    {
        return view('livewire.admin.about-us')
            ->layout('layouts.admin');
    }
}
