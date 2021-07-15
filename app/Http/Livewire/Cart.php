<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Cart extends Component
{
    public $total = 0;
    public $carts;
    public $qty = [];

    protected $listeners = ['updateQty', 'delete'];

    public function delete($id)
    {
        \App\Models\Cart::destroy($id);
        $this->emit('cartUpdated');
    }

    public function updateQty($id, $qty)
    {
        $cart = \App\Models\Cart::where('id', $id)->with('attribute')->first();

        $pQty = $cart->attribute->qty;

        if ($pQty < $qty) {
            $qty = $pQty;
        } else if ($qty < 1) {
            $qty = 1;
        }

        $cart->update(['qty' => $qty]);
    }

    public function render()
    {
        $this->carts = \App\Models\Cart::where('user_id', userId())
            ->with('product')
            ->with('attribute')
            ->latest()->get();

        $this->total = 0;
        foreach ($this->carts as $cart) {
            $this->total += $cart->attribute->price * $cart->qty;
        }

        return view('livewire.cart')
            ->extends('layouts.app')
            ->section('contents');
    }
}
