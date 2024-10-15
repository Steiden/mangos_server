<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\ExecutionStatus;
use App\Models\TaskPriority;
use App\Models\TaskTag;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConditionValueObjectResource extends JsonResource
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
            'attribute_name' => $this->attribute_name,
            'value' => $this->value,
            'task_tag' => new TaskTagResource(TaskTag::where('id', $request->task_tag_id)->firstOr([])),
            'category' => new CategoryResource(Category::where('id', $request->category_id)->firstOr([])),
            'execution_status' => new ExecutionStatusResource(ExecutionStatus::where('id', $request->execution_status_id)->firstOr([])),
            'task_priority' => new TaskPriorityResource(TaskPriority::where('id', $request->task_priority_id)->firstOr([])),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
