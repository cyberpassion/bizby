<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
	public $name;
    public $id;
    public $label;
    public $placeholder;
    public $class;
    public $mandatory;
    public $type;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $name = '',
        $id = '',
        $label = '',
        $placeholder = '',
        $class = '',
        $mandatory = false,
        $type = 'text' // default input type
    ) {
        $this->name = $name;
        $this->id = $id ?: $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->class = $class;
        $this->mandatory = $mandatory;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
