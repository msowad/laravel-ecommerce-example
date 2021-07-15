<?php

namespace App\Http\Livewire\Child;

use Livewire\Component;

class SingleProduct extends Component
{
    public $product;
    public $moreAttr;
    public $rate;

    public function dehydrate()
    {
        $this->emit('observeImage');
    }

    public function addToCart()
    {
        $cart = new ProductDetailPartial();
        $cart->addToCart($this->product->id, $this->product->onSaleAttributes->first()->id, 1);
        $this->emit('cartUpdated');
    }

    public function addTowishlist()
    {
        $wishlist = new ProductDetailPartial();
        $wishlist->addTowishlist($this->product->id, $this->product->onSaleAttributes->first()->id);
    }

    public function render()
    {
        $this->moreAttr = $this->product->onSaleAttributes->count() - 1;
        if ($this->product->onSaleAttributes->first()->maxRate->count() > 0) {
            $this->rate = $this->product->onSaleAttributes->first()->maxRate->first()->max_rate;
        }

        return view('livewire.child.single-product');
    }
}
