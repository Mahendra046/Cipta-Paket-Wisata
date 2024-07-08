<?php

namespace App\View\Components\LayoutApp\Button;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InfoButton extends Component
{
    /**
     * Create a new component instance.
     */
    public $url;
    public $id;
    public function __construct($url = null, $id = null)
    {
        $this->url = $url;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layout-app.button.info-button');
    }
}
