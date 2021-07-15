<?php

namespace App\Http\Livewire\Child;

use App\Models\Category;
use Livewire\Component;

class ShopMenu extends Component
{
    public function render()
    {
        $categories = Category::with('subCategories')
            ->withCount('subCategories')
            ->has('products')
            ->where('parent_category', '==', 0)
            ->orderBy('sub_categories_count', 'desc')
            ->where('status', 1)->get();
        // dd($categories);
        return view('livewire.child.shop-menu', ['categories' => $categories]);
    }
}
