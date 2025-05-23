<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class DaftarPemohonInformasiPublikResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'applicant' => [
                'name' => $this->applicant->name,
                'address' => $this->applicant->address,
                'phone' => $this->applicant->phone,
                'email' => $this->applicant->email,
                'identifier' => [
                    'document' => $this->applicant->identifierMethod->name,
                    'value' => $this->applicant->applicant_identifier_value,
                    'attachment' => url(Storage::url($this->applicant->applicant_identifier_attachment)),
                ]
            ],
            'application' => [
                'uuid' => $this->uuid,
                'reg_num' => $this->reg_num,
                'application_method' => $this->applicationMethod->name,
                'information_requested' => $this->information_requested,
                'information_purposes' => $this->information_purposes,
                'information_receival' => [
                    'method' => $this->informationReceival->name,
                    'is_get_copy' => $this->is_get_copy,
                    'get_copy_method' => $this->get_copy_method,
                ],
                'application_note' => $this->note,

            ],
            'application_histories' => $this->applicationHistory
                ->sortByDesc('updated_at')
                ->values()
                ->map(function ($history) {
                    return [
                        'status' => $history->applicationStatus->name,
                        'note' => $history->note,
                        'updated_at' => $history->updated_at->format('Y-m-d H:i:s'),
                    ];
                }),
        ];
    }
}
