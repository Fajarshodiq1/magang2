<?php

namespace App\View\Components\Ui;

use Illuminate\View\Component;

class Button extends Component
{
    public string $variant;
    public string $type;
    public ?string $href;
    public ?string $loading;

    public function __construct(
        string $variant = 'primary',
        string $type = 'button',
        ?string $href = null,
        ?string $loading = null
    ) {
        $this->variant = $variant;
        $this->type = $type;
        $this->href = $href;
        $this->loading = $loading;
    }

    public function render()
    {
        return view('components.ui.button');
    }
}
