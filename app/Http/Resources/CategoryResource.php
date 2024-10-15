<?php

namespace App\Http\Resources;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'project' => new ProjectResource(Project::where('id', $this->project_id)->first()),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
