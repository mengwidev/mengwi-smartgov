<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\{
    Applicant,
    PublicInformationApplication,
    ApplicationStatus,
    ApplicationMethod,
    InformationReceival,
    ApplicantIdentifierMethod
};

class PublicInformationApplicationForm extends Component
{
    use WithFileUploads;

    public $pageTitle = 'Public Information Application Form';


    // Application fields
    public $reg_num;
    public $application_status_id;
    public $application_method_id;
    public $information_requested;
    public $information_purposes;
    public $information_receival_id;
    public $get_copy_method;
    public $note;

    // Applicant fields
    public $applicant_name;
    public $applicant_address;
    public $applicant_phone;
    public $applicant_email;
    public $applicant_identifier_method_id;
    public $applicant_identifier_value;
    public $applicant_identifier_attachment; // skip upload for now
    public $onlineReceivalId;
    public function mount()
    {
        $this->pageTitle = 'Permohonan Informasi Publik | PPID Desa Mengwi';
        $this->application_status_id = ApplicationStatus::where('name', 'Belum Diproses')->value('id');
        $this->application_method_id = ApplicationMethod::where('name', 'Online')->value('id');

        // Important: check if it returns a value
        $this->onlineReceivalId = InformationReceival::where('name', 'Mendapatkan Salinan Informasi')->value('id');

        // Optional: fail-safe
        if (!$this->onlineReceivalId) {
            throw new \Exception("Receival method 'Mendapatkan Salinan Informasi' not found!");
        }
    }


    protected function generateRegNum()
    {
        return PublicInformationApplication::getConnectionResolver()
            ->connection()
            ->transaction(function () {
                $today = now()->format('Ymd');
                $kodeDesa = config('desa.kode');
                $prefix = "{$kodeDesa}/PPID/REG/{$today}";

                $count = PublicInformationApplication::query()
                    ->whereDate('created_at', now()->toDateString())
                    ->lockForUpdate()
                    ->count();

                $index = str_pad($count + 1, 3, '0', STR_PAD_LEFT);

                return "{$prefix}/{$index}";
            });
    }

    public function save()
    {
        $this->validate([
            // Applicant
            'applicant_name' => 'required|string|max:255',
            'applicant_address' => 'required|string|max:500',
            'applicant_phone' => 'required|string|max:20',
            'applicant_email' => 'required|email|max:255',
            'applicant_identifier_method_id' => 'required|integer',
            'applicant_identifier_value' => 'required|string|max:255',
            'applicant_identifier_attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',

            // Application
            'application_status_id' => 'required|exists:application_statuses,id',
            'application_method_id' => 'required|exists:application_methods,id',
            'information_requested' => 'required|string',
            'information_purposes' => 'required|string',
            'information_receival_id' => 'required|integer',
            'get_copy_method' => 'nullable|string',
            'note' => 'nullable|string',
        ]);

        $filePath = null;
        if ($this->applicant_identifier_attachment) {
            // Store the file in 'public/attachments' folder, with unique name
            $filePath = $this->applicant_identifier_attachment->store('attachments', 'public');
        }
        // Generating registration number
        $reg_num = $this->generateRegNum();

        // Step 1: Create Applicant
        $applicant = Applicant::create([
            'name' => $this->applicant_name,
            'address' => $this->applicant_address,
            'phone' => $this->applicant_phone,
            'email' => $this->applicant_email,
            'applicant_identifier_method_id' => $this->applicant_identifier_method_id,
            'applicant_identifier_value' => $this->applicant_identifier_value,
            'applicant_identifier_attachment' => $filePath
        ]);

        // Step 2: Create Application
        $application = PublicInformationApplication::create([
            'reg_num' => $reg_num,
            'applicant_id' => $applicant->id,
            'application_status_id' => $this->application_status_id,
            'application_method_id' => $this->application_method_id,
            'information_requested' => $this->information_requested,
            'information_purposes' => $this->information_purposes,
            'information_receival_id' => $this->information_receival_id,
            'is_get_copy' => (int) $this->information_receival_id === (int) $this->onlineReceivalId,
            'get_copy_method' => $this->get_copy_method,
            'note' => $this->note,
            'status_updated_at' => now(),
        ]);

        session()->flash('message', 'Application and applicant created successfully.');
        return redirect()->route('applications.success', ['public_information_application' => $application->uuid]);
    }

    public function shouldShowCopyMethod()
    {
        return (int) $this->information_receival_id === (int) $this->onlineReceivalId;
    }

    public function render()
    {
        return view('livewire.ppid.public-information-application-form', [
            'statuses' => ApplicationStatus::all(),
            'methods' => ApplicationMethod::all(),
            'receivals' => InformationReceival::all(),
            'identifierMethods' => ApplicantIdentifierMethod::all(),
            'onlineReceivalId' => $this->onlineReceivalId,
        ]);
    }
}
