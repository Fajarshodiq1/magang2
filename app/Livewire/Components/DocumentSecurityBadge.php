<?php

namespace App\Livewire\Components;

use App\Models\Document;
use App\Services\DocumentSecurity;
use Livewire\Component;

class DocumentSecurityBadge extends Component
{
    public Document $document;
    public $showDetails = false;

    protected $security;

    public function mount(Document $document)
    {
        $this->document = $document;
        $this->security = new DocumentSecurity();
    }

    public function toggleDetails()
    {
        $this->showDetails = !$this->showDetails;
    }

    public function verifyDocument()
    {
        $verification = $this->security->verifyDocument($this->document);

        if ($verification['status'] === 'verified') {
            session()->flash('success', 'Dokumen terverifikasi dengan sempurna!');
        } else {
            session()->flash('warning', 'Verifikasi dokumen menunjukkan ada masalah: ' . implode(', ', $verification['messages']));
        }

        $this->dispatch('document-verified');
    }

    public function downloadQR()
    {
        return redirect()->route('documents.qr.download', $this->document->id);
    }

    public function render()
    {
        return view('livewire.components.document-security-badge');
    }
}
