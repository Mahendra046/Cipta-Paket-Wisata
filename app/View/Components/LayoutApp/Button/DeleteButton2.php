<?php

namespace App\View\Components\LayoutApp\Button;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteButton2 extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $id = null, public $path = null)
    {
        $this->id = $id;
        $this->path = $path;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layout-app.button.delete-button2');
    }
}
