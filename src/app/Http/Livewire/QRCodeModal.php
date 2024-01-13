<?php

namespace App\Http\Livewire;

use Livewire\Component;

class QRCodeModal extends Component
{
    public $showModal = false;
    public $reservationId;

    public function render() {
        return view('livewire.q-r-code-modal');
    }

    public function openModal($reservationId) {
        $this->reservationId = $reservationId;
        $this->showModal = true;
    }

    public function closeModal() {
        $this->showModal = false;
    }
}