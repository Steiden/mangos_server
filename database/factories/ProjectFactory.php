<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\ExecutionStatus;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
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
            'description' => $this->faker->paragraph(),
            'avatar' => $this->faker->imageUrl(),
            'execution_status_id' => ExecutionStatus::all()->random()->id,
            'organization_id' => Organization::all()->random()->id,
            // 'chat_id' => Chat::all()->random()->id,
            'user_id' => User::all()->random()->id
        ];
    }
}
