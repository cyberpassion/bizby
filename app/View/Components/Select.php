<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    public $name;
    public $id;
    public $label;
    public $options;
    public $class;
    public $mandatory;
    public $dataKey;
    public $selected;

    public function __construct(
        $name,
        $id = '',
        $label = '',
        $class = '',
        $mandatory = false,
        $dataKey = '',
        $selected = null
    ) {
        $this->name = $name;
        $this->id = $id ?: $name;
        $this->label = $label;
        $this->class = $class;
        $this->mandatory = $mandatory;
        $this->dataKey = $dataKey;
        $this->selected = old($name, $selected);

        // Resolve options based on dataKey
        $this->options = $this->resolveOptions($dataKey);
    }

    /**
     * Resolve options based on a key like 'gender-json'.
     */
    protected function resolveOptions($key)
    {
        $optionsMap = [
            'gender-json' => [
                'm' => 'Male',
                'f' => 'Female',
                'o' => 'Other',
            ],
            // Add more keys here if needed
            // 'status-json' => [...],
        ];

        return $optionsMap[$key] ?? [];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select');
    }
}
