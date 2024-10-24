<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\ExecutionStatus;
use App\Models\Tag;
use App\Models\TaskPriority;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ConditionValueObject>
 */
class ConditionValueObjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'attribute_name' => $this->faker->unique()->word(),
            'value' => $this->faker->unique()->word(),
            'category_id' => Category::all()->random()->id,
            'execution_status_id' => ExecutionStatus::all()->random()->id,
            'task_priority_id' => TaskPriority::all()->random()->id,
            'tag_id' => Tag::all()->random()->id
        ];
    }
}
