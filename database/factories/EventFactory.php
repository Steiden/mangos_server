<?php

namespace Database\Factories;

use App\Models\EventRepeat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
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
            'started_at' => $this->faker->date('Y-m-d H:i:s'),
            'finished_at' => $this->faker->date('Y-m-d H:i:s'),
            'is_important' => $this->faker->boolean(20),
            'user_id' => User::all()->random()->id,
            'event_repeat_id' => EventRepeat::all()->random()->id
        ];
    }
}
