<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class FileUpload extends Component
{
    public function __construct(
        public string $model,
        public string $label,
        public string $accept = '',
        public string $maxSize = '10MB',
        public bool $required = false
    ) {}

    public function render()
    {
        return view('components.form.file-upload');
    }
}
