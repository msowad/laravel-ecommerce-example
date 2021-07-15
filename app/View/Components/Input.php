<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public $label;
    public $name;
    public $autofocus;
    public $type;
    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label = null, $autofocus = false, $type = 'text', $value = null)
    {
        $this->name      = $name;
        $this->label     = $label ?? ucwords($name);
        $this->autofocus = $autofocus;
        $this->type      = $type;
        $this->value     = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.input');
    }
}
