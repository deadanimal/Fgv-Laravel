<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Header extends Component
{
    public $main;
    public $sub;
    public $sub2;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($main, $sub, $sub2)
    {
        $this->main = $main;
        $this->sub = $sub;
        $this->sub2 = $sub2;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.header');
    }
}
