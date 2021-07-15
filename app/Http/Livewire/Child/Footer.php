<?php

namespace App\Http\Livewire\Child;

use App\Models\MyShop;
use Livewire\Component;

class Footer extends Component
{
    public $myShop;
    public $email;

    public function submit()
    {
        $this->validate(['email' => 'required|email']);

        session()->flash('success_msg', 'Thanks for joining with us.');
        $this->reset('email');
    }

    public function render()
    {
        if (cache()->has('app.footer')) {
            $this->myShop = cache("app.footer");
        } else {
            $this->myShop = MyShop::first([
                "short_description",
                "facebook",
                "twitter",
                "instagram",
                "linkedin",
                "youtube",
                "google_plus",
                "mobile1",
                "mobile2",
                "mail1",
                "mail2",
            ]);
            cache()->put("app.footer", $this->myShop, now()->addHours(72));
        }

        return view('livewire.child.footer');
    }
}
