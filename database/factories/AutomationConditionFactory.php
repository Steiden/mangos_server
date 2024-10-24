<?php

namespace Database\Factories;

use App\Models\ComparisonType;
use App\Models\ConditionObject;
use App\Models\ConditionValueObject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AutomationCondition>
 */
class AutomationConditionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'condition_object_id' => ConditionObject::all()->random()->id,
            'comparison_type_id' => ComparisonType::all()->random()->id,
            'condition_value_object_id' => ConditionValueObject::all()->random()->id
        ];
    }
}
