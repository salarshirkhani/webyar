<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class CardBody extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return <<<blade
<div {{ \$attributes->merge(['class' => 'card-body']) }}>
    {{ \$slot }}
</div>
blade;
    }
}
