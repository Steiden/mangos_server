<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\ExecutionStatus;
use App\Models\Project;
use App\Models\Tag;
use App\Models\TaskMember;
use App\Models\TaskPriority;
use App\Models\TaskTag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            'started_at' => $this->started_at,
            'finished_at' => $this->finished_at,
            'execution_status' => new ExecutionStatusResource(ExecutionStatus::where('id', $this->execution_status_id)->first()),
            'task_priority' => new TaskPriorityResource(TaskPriority::where('id', $this->task_priority_id)->first()),
            'category' => new CategoryShortResource(Category::where('id', $this->category_id)->first()),
            'user' => new UserShortResource(User::where('id', $this->user_id)->first()),
            'project' => new ProjectShortResource(Project::where('id', $this->project_id)->first()),
            'tags' => TagResource::collection(Tag::whereIn(
                'id',
                TaskTag::where('task_id', $this->id)->pluck('tag_id')->toArray()
            )->get()),
            'members' => UserShortResource::collection(
                User::whereIn(
                    'id', 
                    TaskMember::where('id', $this->id)->pluck('user_id')->toArray())->get()),            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
