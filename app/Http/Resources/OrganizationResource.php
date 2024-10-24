<?php

namespace App\Http\Resources;

use App\Models\ActivityType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationResource extends JsonResource
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
            'full_name' => $this->full_name,
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
            'activity_type' => new ActivityTypeResource(ActivityType::where('id', $this->activity_type_id)->first()),
            'user' => new UserShortResource(User::find($this->user_id)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
