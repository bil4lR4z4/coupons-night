<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Password extends Component
{
    public $name;
    public $labelClass;
    public $label;
    public $placeholder;
    public $class;
    public $size;
    public $wrapperClass;
    public $id;
    public $required;
    public $readonly;
    public $disabled;
    public $maxlength;
    public $minlength;
    public $autocomplete;
    public $autofocus;

    public function __construct(
        $name,
        $label = '',
        $labelClass = '',
        $placeholder = '',
        $class = '',
        $size = '',
        $wrapperClass = '',
        $id = null,
        $required = false,
        $readonly = false,
        $disabled = false,
        $maxlength = null,
        $minlength = null,
        $autocomplete = 'off',
        $autofocus = false
    ){
        $this->name = $name;
        $this->label = $label;
        $this->labelClass = $labelClass;
        $this->placeholder = $placeholder;
        $this->class = $class;
        $this->size = $size;
        $this->wrapperClass = $wrapperClass;
        $this->id = $id ?? $name;
        $this->required = filter_var($required, FILTER_VALIDATE_BOOLEAN);
        $this->readonly = filter_var($readonly, FILTER_VALIDATE_BOOLEAN);
        $this->disabled = filter_var($disabled, FILTER_VALIDATE_BOOLEAN);
        $this->maxlength = $maxlength;
        $this->minlength = $minlength;
        $this->autocomplete = $autocomplete;
        $this->autofocus = filter_var($autofocus, FILTER_VALIDATE_BOOLEAN);
    }
    
    public function render(): View|Closure|string
    {
        return view('components.password');
    }
}
