<?php

namespace App\Http\Resources;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatMemberResource extends JsonResource
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
            'chat' => new ChatShortResource(Chat::where('id', $this->chat_id)->first()),
            'user' => new UserShortResource(User::where('id', $this->user_id)->first()),
            'is_moderator' => $this->is_moderator,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
