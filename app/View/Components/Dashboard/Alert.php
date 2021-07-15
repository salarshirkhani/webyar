<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class Alert extends Component
{
    public $type;

    /**
     * Create a new component instance.
     *
     * @param $type
     */
    public function __construct($type = null)
    {
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.dashboard.alert');
    }
}
