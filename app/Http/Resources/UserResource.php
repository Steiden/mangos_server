<?php

namespace App\Http\Resources;

use App\Models\Chat;
use App\Models\ChatMember;
use App\Models\Division;
use App\Models\Organization;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $role = Role::find($this->role_id);
        $user = User::find($this->user_id);
        $post = Post::find($this->post_id);

        return [
            'id' => $this->id,
            'login' => $this->login,
            'avatar' => $this->avatar,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'patronymic' => $this->patronymic,
            'phone' => $this->phone,
            'email' => $this->email,
            'is_subordinate' => $this->is_subordinate,
            'verified_at' => $this->verified_at,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'role' => new RoleResource($role),
            'post' => new PostShortResource($post),
            'user' => new UserShortResource($user),
            'chats' => ChatShortResource::collection(Chat::whereIn(
                'id',
                ChatMember::where('user_id', $this->id)->pluck('chat_id')->toArray()
            )->get())
        ];
    }
}
