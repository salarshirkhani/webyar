<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class BreadcrumbItem extends Component
{
    public $title;
    public $route;
    public $routeParam;

    /**
     * Create a new component instance.
     *
     * @param $title
     * @param $route
     * @param $routeParam
     */
    public function __construct($title, $route, $routeParam = [])
    {
        $this->title = $title;
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
        return view('components.dashboard.breadcrumb-item');
    }
}
