<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\ExecutionStatus;
use App\Models\Project;
use App\Models\TaskPriority;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'description' => $this->faker->sentence(10),
            'started_at' => $this->faker->dateTime(),
            'finished_at' => $this->faker->dateTimeBetween('now', '+12 month'),
            'execution_status_id' => ExecutionStatus::all()->random()->id,
            'task_priority_id' => TaskPriority::all()->random()->id,
            'category_id' => Category::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'project_id' => Project::all()->random()->id,
        ];
    }
}
