<?php

namespace App\View\Components\Form;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class FileGroup extends Input
{
    public function __construct($name, $label = null, $width = null)
    {
        parent::__construct($name, $label, $width, null, null);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form.file-group');
    }
}
