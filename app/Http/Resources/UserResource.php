<?php

namespace App\Http\Resources;

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
            'role' => new RoleResource(Role::where('id', $this->role_id)->first()),
            'post' => new PostResource(Post::where('id', $this->post_id)->first()),
            'division' => new DivisionResource(Division::where('id', $this->division_id)->first()),
            'boss' => new UserResource(User::where('id', $this->user_id)->first()),
            'organization' => new OrganizationResource(Organization::where('id', $this->organization_id)->first()),
        ];
    }
}
