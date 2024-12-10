<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'login' => $this->faker->unique()->word(),
            'password' => $this->faker->password(),
            'avatar' => $this->faker->imageUrl(),
            'first_name' => $this->faker->firstName(),
            'second_name' => $this->faker->lastName(),
            'patronymic' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            // 'is_subordinate' => $this->faker->boolean(),
            'verified_at' => $this->faker->dateTimeBetween("-2 month"),
            'role_id' => Role::all()->random()->id,
            // 'post_id' => Post::all()->random()->id,
            // 'user_id' => User::all()->random()->id,
        ];
    }
}
