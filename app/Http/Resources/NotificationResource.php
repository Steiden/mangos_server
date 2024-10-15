<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'title' => $this->title,
            'text' => $this->text,
            'is_read' => $this->is_read,
            'user' => new UserResource(User::where('id', $this->user_id)->first()),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
