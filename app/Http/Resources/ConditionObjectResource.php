<?php

namespace App\Http\Resources;

use App\Models\Event;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConditionObjectResource extends JsonResource
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
            'task' => new TaskResource(Task::where(['id' => $this->task_id])->firstOr([])),
            'event' => new EventResource(Event::where(['id' => $this->event_id])->firstOr([])),
        ];
    }
}
