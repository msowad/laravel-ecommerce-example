<?php

namespace App\Http\Livewire\Child;

use App\Models\Category;
use Livewire\Component;

class HomeCategories extends Component
{
    public function render()
    {
        $categories = Category::withCount('products')
            ->with('photo')
            ->has('products')
            ->where('status', 1)
            ->where('in_home_page', 1)
            ->whereHas('photo')
            ->orderBy('products_count', 'desc')
            ->limit(4)->get();

        return view('livewire.child.home-categories', ['categories' => $categories]);
    }
}
