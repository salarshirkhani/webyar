<?php

namespace App\View\Components\Form;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

abstract class Input extends Component
{
    public $name;
    public $label;
    public $width;

    public $model;
    public $default;

    /**
     * Create a new component instance.
     *
     * @param $name
     * @param $label
     * @param string|null $width
     * @param Model|null $model
     * @param mixed $default
     */
    public function __construct($name, $label = null, $width = null, $model = null, $default = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->width = $width;

        $this->model = $model;
        $this->default = $default;
    }


    public function value()
    {
        if (\Session::hasOldInput($this->name))
            return \Session::getOldInput($this->name);

        elseif ($this->default != null)
            return $this->default;

        elseif (!empty($this->model) && ($value = $this->model->getAttribute($this->name)) != null)
            return $value;

        else
            return null;
    }
}
