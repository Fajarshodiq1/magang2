<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class InputText extends Component
{
    public string $label;
    public string $type;
    public string $name;
    public string $placeholder;
    public bool $required;

    public function __construct(
        string $label,
        string $type,
        string $name,
        string $placeholder = '',
        bool $required = false
    ) {
        $this->label = $label;
        $this->type = $type;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->required = $required;
    }

    public function render()
    {
        return view('components.form.input-text');
    }
}