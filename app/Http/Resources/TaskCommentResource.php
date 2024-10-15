<?php

namespace App\Http\Resources;

use App\Models\Message;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskCommentResource extends JsonResource
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
            'task' => new TaskResource(Task::where('id', $this->task_id)->first()),
            'message' => new MessageResource(Message::where('id', $this->message_id)->first()),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
