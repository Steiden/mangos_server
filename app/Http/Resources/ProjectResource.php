<?php

namespace App\Http\Resources;

use App\Models\Chat;
use App\Models\ExecutionStatus;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'description' => $this->description,
            'avatar' => $this->avatar,
            'execution_status' => new ExecutionStatusResource(ExecutionStatus::where('id', $this->execeution_status_id)->first()),
            'organization_id' => new OrganizationResource(Organization::where('id', $this->organization_id)->first()),
            'chat' => new ChatResource(Chat::where('id', $this->chat_id)->firstOr([])),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
