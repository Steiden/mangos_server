<?php

namespace Database\Factories;

use App\Models\Organization;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrganizationEmployee>
 */
class OrganizationEmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'organization_id' => Organization::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'post_id' => Post::all()->random()->id
        ];
    }
}
