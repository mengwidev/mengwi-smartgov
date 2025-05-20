<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PublicInformationApplication;

class PublicInformationApplicationSuccess extends Component
{
    public $application;

    public function mount($id)
    {
        $this->application = PublicInformationApplication::with([
            'applicant',
            'applicationStatus',
            'applicationMethod',
            'informationReceival'
        ])->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.public-information-application-success');
    }
}
