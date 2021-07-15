<?php

namespace App\Http\Livewire\Admin\Product;

use Livewire\Component;
use Livewire\WithFileUploads;

class Detail extends Component
{
    use WithFileUploads;

    public $editId;

    public $photo;

    public $skus;
    public $mrps;
    public $prices;
    public $qtys;
    public $sizes;
    public $colors;
    public $products;
    public $statuses;

    public function updatedPhotos()
    {
        $this->validate(['photos.*' => 'image|mimes:jpeg,jpg,png']);
        // dd($this->photos[0]->temporaryUrl());
    }

    public function render()
    {
        return view('livewire.admin.product.detail');
    }
}
