<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MInput extends Component
{
    public $name;
    public $id;
    public $span;
    public $label;
    public $type;
    public $required;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $id = null, $span = 12, $label = null, $type = 'text', $required = false)
    {
        $this->name     = $name;
        $this->id       = $id ?? $name;
        $this->span     = $span;
        $this->label    = $label ?? ucwords($name);
        $this->type     = $type;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.m-input');
    }
}
