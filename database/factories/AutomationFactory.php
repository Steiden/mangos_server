<?php

namespace Database\Factories;

use App\Models\AutomationAction;
use App\Models\AutomationCondition;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Automation>
 */
class AutomationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'automation_action_id' => AutomationAction::all()->random()->id,
            'automation_condition_id' => AutomationCondition::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'project_id' => Project::all()->random()->id,
        ];
    }
}
