<?php

namespace App\Http\Resources;

use App\Models\AutomationAction;
use App\Models\AutomationCondition;
use App\Models\Organization;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AutomationResource extends JsonResource
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
            'automation_action' => new AutomationResource(AutomationAction::where('id', $this->automation_action_id)->first()),
            'automation_condition' => new AutomationConditionResource(AutomationCondition::where('id', $this->automation_condition_id)->first()),
            'user' => new UserResource(User::where('id', $this->user_id)->first()),
            'organization' => new OrganizationResource(Organization::where('id', $this->organization_id)->first()),
            'project' => new ProjectResource(Project::where('id', $this->project_id)->first()),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
