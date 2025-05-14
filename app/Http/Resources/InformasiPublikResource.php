<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InformasiPublikResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'summary' => $this->summary,
            'year' => $this->year,
            'filepath' => $this->filepath
                ? asset('storage/' . $this->filepath)
                : null,
            'information_classification' => [
                'name' => $this->informationClassification->name,
            ],
            'document_category' => [
                'name' => $this->documentCategory->name,
            ],
        ];
    }
}
