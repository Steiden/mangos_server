<?php

namespace App\Http\Resources;

use App\Models\Chat;
use App\Models\ChatMember;
use App\Models\Division;
use App\Models\Organization;
use App\Models\OrganizationEmployee;
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
            'second_name' => $this->second_name,
            'patronymic' => $this->patronymic,
            'phone' => $this->phone,
            'email' => $this->email,
            'verified_at' => $this->verified_at,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'role' => new RoleResource(Role::where('id', $this->role_id)->first()),
            'organizations' => OrganizationResource::collection(
                Organization::whereIn('id',
                    OrganizationEmployee::where('user_id', $this->id)
                        ->pluck('organization_id')
                )->get()
            ),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
