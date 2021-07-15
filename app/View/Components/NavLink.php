<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NavLink extends Component
{
    public $icon;
    public $label;
    public $route;
    public $can;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $route, $can, $icon = null)
    {
        $this->icon  = $icon;
        $this->label = $label;
        $this->route = $route;
        $this->can   = $can;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.nav-link');
    }
}
