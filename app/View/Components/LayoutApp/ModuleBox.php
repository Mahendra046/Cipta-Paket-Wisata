<?php

namespace App\View\Components\LayoutApp;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModuleBox extends Component
{
    /**
     * Create a new component instance.
     */
    public $color;
    public $title;
    public $subtitle;
    public $url;
    public function __construct($color = null, $title = null, $subtitle = null, $url = null)
    {
        $this->color = $color;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->url = $url;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layout-app.module-box');
    }
}
