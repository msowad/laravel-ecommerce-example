<?php

namespace App\Http\Livewire\Child;

use App\Models\Slider;
use Livewire\Component;

class HomeSlider extends Component
{
    public function render()
    {
        $sliders = Slider::where('status', 1)->with('photo')->orderBy('order_id')->get();

        return view('livewire.child.home-slider', [
            'sliders' => $sliders,
        ]);
    }
}
