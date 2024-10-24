<?php

namespace App\Http\Resources;

use App\Models\ChatMember;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
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
            'avatar' => $this->avatar,
            'user' => new UserResource(User::where('id', $this->user_id)->first()),
            'messages' => MessageResource::collection(ChatMessage::where('chat_idcolumns: ', $this->id)),
            'members' => UserResource::collection(ChatMember::where('chat_id', $this->id)),
            'moderators' => UserResource::collection(ChatMember::where('chat_id', $this->id)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
