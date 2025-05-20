<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PublicInformationApplication;

class PublicInformationApplicationSuccess extends Component
{
    public $application;

    public function mount($public_information_application)
    {
        $this->application = PublicInformationApplication::where('uuid', $public_information_application)
            ->with([
                'applicant',
                'applicationStatus',
                'applicationMethod',
                'informationReceival',
            ])
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.ppid.public-information-application-success');
    }
}
