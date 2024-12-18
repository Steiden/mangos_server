<?php

namespace App\Http\Resources;

use App\Models\Chat;
use App\Models\ExecutionStatus;
use App\Models\Organization;
use App\Models\ProjectMember;
use App\Models\User;
use App\Models\Task;
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
            'execution_status' => new ExecutionStatusResource(ExecutionStatus::where('id', $this->execution_status_id)->first()),
            'organization_id' => new OrganizationShortResource(Organization::where('id', $this->organization_id)->first()),
            'user' => new UserShortResource(User::find($this->user_id)->first()),
            'members' => ProjectMemberResource::collection(ProjectMember::where('project_id', $this->id)->get()),
            'tasks' => TaskMiddleResource::collection(Task::where('project_id', $this->id)->get()),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
