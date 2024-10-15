<?php

namespace App\Http\Resources;

use App\Models\ComparisonType;
use App\Models\ConditionObject;
use App\Models\ConditionValueObject;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AutomationConditionResource extends JsonResource
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
            'condition_object' => new ConditionObjectResource(ConditionObject::where('id', $this->condition_object_id)->first()),
            'comparison_type' => new ComparisonTypeResource(ComparisonType::where('id', $this->comparison_type_id)->first()),
            'condition_value_object' => new ConditionValueObjectResource(ConditionValueObject::where('id', $this->condition_value_object_id)->first()),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
