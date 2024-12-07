<?php

namespace App\Http\Resources;

use App\Models\EventRepeat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'is_important' => $this->is_important,
            'user' => new UserShortResource(User::where('id', $this->user_id)->first()),
            'event_repeat' => new EventRepeatResource(EventRepeat::where('id', $this->event_repeat_id)->first()),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
