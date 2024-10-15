<?php

namespace App\Http\Resources;

use App\Models\Automation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AutomationEditorResource extends JsonResource
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
            'automation' => new AutomationResource(Automation::where('id', $this->automation_id)->first()),
            'user' => new UserResource(User::where('id', $this->user_id)->first()),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
