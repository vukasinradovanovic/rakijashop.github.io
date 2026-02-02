<?php

namespace App\View\Components\validation;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class pop-up-window extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.validation.pop-up-window');
    }
}
