<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class App extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $menu;
    public $page;
    public $url;
    public function __construct($title = null, $menu = null, $page = null, $url = null)
    {
        $this->title = $title;
        $this->menu = $menu;
        $this->page = $page;
        $this->url = $url;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.app');
    }
}
