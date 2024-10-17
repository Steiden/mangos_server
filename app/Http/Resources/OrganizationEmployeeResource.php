<?php

namespace App\Http\Resources;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationEmployeeResource extends JsonResource
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
            'organization' => new OrganizationResource(Organization::find($this->organization_id)),
            'user' => new UserResource(User::find($this->user_id)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
