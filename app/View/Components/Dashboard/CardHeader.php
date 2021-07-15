<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class CardHeader extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return <<<blade
<div {{ \$attributes->merge(['class' => 'card-header']) }}>
    <h3 class="card-title">{{ \$slot }}</h3>
    {{ \$down ?? '' }}
</div>
blade;
    }
}
