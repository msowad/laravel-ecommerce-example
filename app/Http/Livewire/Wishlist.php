<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Wishlist extends Component
{
    protected $listeners = ['remove'];

    public function remove($id)
    {
        \App\Models\wishlist::destroy($id);
    }

    public function render()
    {
        $wishlists = \App\Models\Wishlist::where('user_id', auth()->user()->id)
            ->with('product')
            ->with('attribute')
            ->latest()->get();

        return view('livewire.wishlist', ['wishlists' => $wishlists])
            ->extends('layouts.app')
            ->section('contents');
    }
}
