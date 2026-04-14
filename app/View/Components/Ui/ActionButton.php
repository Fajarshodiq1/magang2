<?php

namespace App\View\Components\Ui;

use Illuminate\View\Component;

class ActionButton extends Component
{
    public string $variant;
    public string $icon;
    public ?string $href;

    public function __construct(
        string $variant = 'default',
        string $icon = 'default',
        ?string $href = null
    ) {
        $this->variant = $variant;
        $this->icon = $icon;
        $this->href = $href;
    }

    public function render()
    {
        return view('components.ui.action-button');
    }
}
