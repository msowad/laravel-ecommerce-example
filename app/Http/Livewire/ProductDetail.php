<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Http\Request;
use Livewire\Component;

class ProductDetail extends Component
{
    public $product;
    public $rate;
    public $attribute;
    public $attributeId;
    public $reviews;

    protected $listeners = ['changeAttr' => 'setAttr'];

    public function setAttr($id)
    {
        $this->attributeId = $id;
        $this->attribute   = $this->product->details->where('id', $this->attributeId)->first();

        $this->getRate();
        $this->getReviews();
        $this->render();
    }

    public function getRate()
    {
        for ($i = 1; $i <= 5; $i++) {
            $this->rate[$i] = $this->attribute->reviews->where('rate', $i)
                ->count();
        }
    }

    public function getReviews()
    {
        $this->reviews = $this->attribute->reviews;
    }

    public function mount($slug, Request $request)
    {
        $this->product = Product::with('details')
            ->has('details')
            ->where('slug', $slug)
            ->firstOrFail();

        if ($request->attribute) {
            $this->attributeId = intval($request->attribute);
        } else {
            $this->attributeId = $this->product->details->first()->id;
        }

        $this->attribute = $this->product->details->where('id', $this->attributeId)->first();

        $this->getRate();
        $this->getReviews();
    }

    public function render()
    {
        return view('livewire.product-detail')
            ->extends('layouts.app')
            ->section('contents');
    }
}
