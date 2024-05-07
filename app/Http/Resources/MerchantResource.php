<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MerchantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "uuid" => $this->uuid,
            "company_name" => $this->company_name,
            "company_tax_id" => $this->company_tax_id,
            "contact_number" => $this->contact_number,
            "address" => $this->address,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
