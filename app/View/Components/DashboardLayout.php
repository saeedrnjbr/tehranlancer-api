<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardLayout extends Component
{
    /**
     * Create a new component instance.
     */

    protected $title;
    protected $link;

    public function __construct($title = "", $link = "")
    {
        $this->title = $title;
        $this->link = $link;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard-layout');
    }
}
