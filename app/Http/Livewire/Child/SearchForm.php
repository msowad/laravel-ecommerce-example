<?php

namespace App\Http\Livewire\Child;

use App\Models\Product;
use Illuminate\Http\Request;
use Livewire\Component;

class SearchForm extends Component
{
    public $search;

    public function searchTags(Request $request)
    {
        $term = $request->term;

        return Product::with('onSaleAttributes')
            ->has('onSaleAttributes')
            ->where(function ($qry) use ($term) {
                $qry->where('name', 'like', '%' . $term . '%')
                    ->orWhere('slug', 'like', '%' . $term . '%')
                    ->orWhere('model', 'like', '%' . $term . '%')
                    ->orWhere('short_description', 'like', '%' . $term . '%')
                    ->orWhere('description', 'like', '%' . $term . '%')
                    ->orWhere('keywords', 'like', '%' . $term . '%')
                    ->orWhere('technical_specification', 'like', '%' . $term . '%')
                    ->orWhere('usage', 'like', '%' . $term . '%')
                    ->orWhere('warrenty', 'like', '%' . $term . '%')
                    ->orWhereHas('category', function ($query) use ($term) {
                        $query->where('name', 'like', '%' . $term . '%')
                            ->where('status', 1)
                            ->orWhere('slug', 'like', '%' . $term . '%');
                    })->orWhereHas('brand', function ($query) use ($term) {
                        $query->where('name', 'like', '%' . $term . '%')
                            ->where('status', 1)
                            ->orWhere('slug', 'like', '%' . $term . '%');
                    });
            })->pluck('name');
    }

    public function updatedSearch()
    {
        return redirect()->route('search', $this->search);
    }

    public function render()
    {
        return view('livewire.child.search-form');
    }
}
