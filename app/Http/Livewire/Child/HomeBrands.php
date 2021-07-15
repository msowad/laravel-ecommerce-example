<?php

namespace App\Http\Livewire\Child;

use App\Models\Brand;
use Livewire\Component;

class HomeBrands extends Component
{
    public function render()
    {
        $brands = Brand::withCount('products')
            ->with('photo')
            ->has('products')
            ->where('status', 1)
            ->whereHas('photo')
            ->where('in_home_page', 1)
            ->orderBy('products_count', 'desc')
            ->get();

        return view('livewire.child.home-brands', ['brands' => $brands]);
    }
}
