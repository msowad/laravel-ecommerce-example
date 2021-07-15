<?php

namespace App\Http\Livewire\Child;

use Livewire\Component;

class TotalCart extends Component
{
    protected $listeners = ['cartUpdated' => 'render'];

    public function render()
    {
        return view('livewire.child.total-cart');
    }
}
