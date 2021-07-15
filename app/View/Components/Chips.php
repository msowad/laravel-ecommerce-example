<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Chips extends Component
{
    public $label;
    public $onDelete;
    public $onClick;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $onDelete = null, $onClick = null)
    {
        $this->label    = $label;
        $this->onDelete = $onDelete;
        $this->onClick  = $onClick;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.chips');
    }
}
