<?php

namespace App\Livewire;

use Livewire\Component;

class PublicInformationLookup extends Component
{
    public $regNum;
    public $application;

    public function search()
    {
        $this->application = \App\Models\PublicInformationApplication::with([
            'applicant.identifierMethod',
            'applicationMethod',
            'informationReceival',
            'applicationHistory.applicationStatus',
        ])->where('reg_num', $this->regNum)->first();
    }

    public function render()
    {
        return view('livewire.public-information-lookup');
    }
}
