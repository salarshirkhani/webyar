<?php

namespace App\View\Components\Form;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class TextareaGroup extends Input
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form.textarea-group');
    }
}
