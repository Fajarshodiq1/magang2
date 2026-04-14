<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Textarea extends Component
{
    public string $label;
    public string $name;
    public string $placeholder;
    public int $rows;
    public bool $required;

    public function __construct(
        string $label,
        string $name,
        string $placeholder = '',
        int $rows = 4,
        bool $required = false
    ) {
        $this->label = $label;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->rows = $rows;
        $this->required = $required;
    }

    public function render()
    {
        return view('components.form.textarea');
    }
}
