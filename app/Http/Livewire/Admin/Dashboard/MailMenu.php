<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\Contact;
use Livewire\Component;

class MailMenu extends Component
{
    public $mails;
    public $count = 0;

    public function markAll()
    {
        Contact::where('readed_at', null)->update([
            'readed_at' => now()
        ]);
        $this->count = 0;
    }

    public function mount()
    {
        $this->mails = Contact::where('readed_at', null)->get();
        $this->count = Contact::where('readed_at', null)->count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard.mail-menu');
    }
}
