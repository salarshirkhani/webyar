<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class SidebarItem extends Component
{
    public $title;
    public $route;
    public $icon;
    public $routeParam;

    /**
     * Create a new component instance.
     *
     * @param $title
     * @param $route
     * @param $icon
     */
    public function __construct($title, $icon, $route = null, $routeParam = [])
    {
        $this->title = $title;
        $this->icon = $icon;
        $this->route = $route;
        $this->routeParam = $routeParam;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.dashboard.sidebar-item');
    }
}
