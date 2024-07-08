<?php

namespace App\View\Components\LayoutApp;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public $menu;
    public function __construct($menu= null)
    {
        $this->menu = $menu;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // $user = Auth::guard('admin');
        return view('components.layout-app.sidebar');
    }
}
