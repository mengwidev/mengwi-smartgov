<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfilPpidResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "role" => $this->role->name,
            "officer" => $this->employee->name,
            "goverment_position" => [
                "employee_level" => $this->employee->employeeLevel->name,
                "employment_unit" => $this->employee->employmentUnit->name,
            ],
            "phone" => optional(
                $this->employee->contacts->firstWhere('contact_type_id', 1)
            )->value,
        ];
    }
}
