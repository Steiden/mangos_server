<?php

namespace App\Http\Resources;

use App\Models\MessageType;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageShortResource extends JsonResource
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
            'text' => $this->text,
            'is_read' => $this->is_read,
            'message_type' => new MessageTypeResource(MessageType::where('id', $this->message_type_id)->first()),
            'user_sending_id' => $this->user_sending_id,
            'user_receiving_id' => $this->user_receiving_id,
            'task_id' => $this->task_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
