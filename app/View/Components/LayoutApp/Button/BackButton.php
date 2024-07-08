<?php

namespace App\View\Components\LayoutApp\Button;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BackButton extends Component
{
    /**
     * Create a new component instance.
     */
    public $url;
    public function __construct($url = null)
    {
        $this->url = $url;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layout-app.button.back-button');
    }
}
