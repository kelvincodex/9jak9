<?php

namespace App\View\Components\breadcumb;

use Illuminate\View\Component;

class BaseBreadcumb extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public $routeName)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.breadcumb.base-breadcumb');
    }
}
