<?php

namespace App\Http\Resources;

use App\Models\Organization;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DivisionResource extends JsonResource
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
            'organization' => new OrganizationShortResource(Organization::find($this->organization_id)->first()),
            'user' => new UserShortResource(User::find($this->user_id)->first()),
            'posts' => PostShortResource::collection(Post::where('division_id', $this->id)->get()),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
