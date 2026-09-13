<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component{

    public $name;
    public $label;
    public $labelClass;
    public $type;
    public $value;
    public $placeholder;
    public $class;
    public $size;
    public $step;
    public $readonly;
    public $id;
    public $required;
    public $disabled;
    public $maxlength;
    public $minlength;
    public $min;
    public $max;
    public $pattern;
    public $autocomplete;
    public $autofocus;
    public $wrapperClass;

    public function __construct(
        $name,
        $label = '',
        $labelClass = '',
        $type = 'text',
        $value = '',
        $placeholder = '',
        $class = '',
        $size = '',
        $step = '',
        $readonly = false,
        $id = null,
        $required = false,
        $disabled = false,
        $maxlength = null,
        $minlength = null,
        $min = null,
        $max = null,
        $pattern = null,
        $autocomplete = 'off',
        $autofocus = false,
        $wrapperClass = ''
    ){
        $this->name = $name;
        $this->label = $label;
        $this->labelClass = $labelClass;
        $this->type = $type;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->class = $class;
        $this->size = $size;
        $this->step = $step;
        $this->readonly = filter_var($readonly, FILTER_VALIDATE_BOOLEAN);
        $this->id = $id ?? $name;
        $this->required = filter_var($required, FILTER_VALIDATE_BOOLEAN);
        $this->disabled = filter_var($disabled, FILTER_VALIDATE_BOOLEAN);
        $this->maxlength = $maxlength;
        $this->minlength = $minlength;
        $this->min = $min;
        $this->max = $max;
        $this->pattern = $pattern;
        $this->autocomplete = $autocomplete;
        $this->autofocus = filter_var($autofocus, FILTER_VALIDATE_BOOLEAN);
        $this->wrapperClass = $wrapperClass;
    }

    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}