<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\ProductDetail;
use Livewire\Component;

class Notifications extends Component
{
    public $products;
    public $count = 0;

    public function dismissAll()
    {
        ProductDetail::where('qty', "<", 6)->where("alert", 1)->update([
            'alert' => 0,
        ]);
        $this->count = 0;
    }

    public function mount()
    {
        $this->products = ProductDetail::where('qty', "<", 6)->with(["product", 'photo'])->get();
        $this->count    = ProductDetail::where('qty', "<", 6)->where("alert", 1)->count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard.notifications');
    }
}
