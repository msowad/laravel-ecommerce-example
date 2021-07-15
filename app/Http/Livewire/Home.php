<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $bestSellers = Product::with('onSaleAttributes')
            ->has('onSaleAttributes')
            ->where('best_seller', 1)
            ->where('status', 1)
            ->latest()->get();

        $featureds = Product::with('onSaleAttributes')
            ->has('onSaleAttributes')
            ->where('featured', 1)
            ->where('status', 1)
            ->latest()->get();

        $trendings = Product::with('onSaleAttributes')
            ->has('onSaleAttributes')
            ->where('trending', 1)
            ->where('status', 1)
            ->latest()->get();

        $discounteds = Product::with('onSaleAttributes')
            ->has('onSaleAttributes')
            ->where('discounted', 1)
            ->where('status', 1)
            ->latest()->get();

        return view('livewire.home', [
            'bestSellers' => $bestSellers,
            'featureds'   => $featureds,
            'trendings'   => $trendings,
            'discounteds' => $discounteds,
        ])
            ->extends('layouts.app')
            ->section('contents');
    }
}
