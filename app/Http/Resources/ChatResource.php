<?php

namespace App\Http\Resources;

use App\Models\ChatMember;
use App\Models\ChatModerator;
use App\Models\Message;
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
            'messages' => MessageResource::collection(Message::where('id', $this->user_id)->get()),
            'members' => UserResource::collection(User::whereIn(
                'id',
                ChatMember::where('chat_id', $this->id)->pluck('user_id')->toArray()
            )->get()),
            'moderators' => UserResource::collection(User::whereIn(
                'id',
                ChatModerator::where('chat_id', $this->id)->pluck('user_id')->toArray()
            )->get()),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
