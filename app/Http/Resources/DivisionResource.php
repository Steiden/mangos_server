<?php

namespace App\Http\Resources;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DivisionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'organization' => new OrganizationResource(Organization::where('id', $this->organization_id)->first()),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
