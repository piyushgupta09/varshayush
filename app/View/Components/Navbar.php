<?php

namespace App\View\Components;

use App\Models\Navlink;
use Illuminate\View\Component;

class Navbar extends Component
{

    public $navlinks;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->navlinks = Navlink::where('group', 'navbar')->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.navbar');
    }
}
