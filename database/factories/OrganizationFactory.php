<?php

namespace Database\Factories;

use App\Models\ActivityType;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organization>
 */
class OrganizationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->sentence(2),
            'name' => $this->faker->word(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'activity_type_id' => ActivityType::all()->random()->id,
            'chat_id' => Chat::all()->random()->id,
            'user_id' => User::all()->random()->id
        ];
    }
}
