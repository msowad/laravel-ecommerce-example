<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MDCCheckbox extends Component
{
    public $name;
    public $span;
    public $label;
    public $rand;
    public $labelFromValue;
    public $value;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $span, $labelFromValue = false, $label = null, $value = null)
    {
        $this->name  = $name;
        $this->value = $value;
        $this->label = $label ?? ucwords($labelFromValue ? $value : $name);
        $this->rand  = rand(11111, 99999);
        $this->span  = $span;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.mdc-checkbox');
    }
}
