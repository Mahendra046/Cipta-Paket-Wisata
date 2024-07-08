<?php

namespace App\View\Components\LayoutApp\Menu;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuItem extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $url;
    public $icon;
    public $active;
    public function __construct($url, $title, $icon)
    {
        $this->url = $url;
        $this->title = $title;
        $this->icon = $icon;
        $this->active = $this->checkActive();
    }

    /**
     * Get the view / contents that represent the component.
     */

    public function checkActive()
    {
        $state = true;
        $url = $this->url;
        $arr_url = explode('/', $url);
        foreach ($arr_url as $key => $value) {
            $segment = request()->segment($key + 1);
            if($segment != $value) $state = false;
        }
        return $state;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layout-app.menu.menu-item');
    }
}
