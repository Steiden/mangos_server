<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\MessageType;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'text' => $this->faker->sentence(),
            'is_read' => false,
            'message_type_id' => MessageType::all()->random()->id,
            'user_sending_id' => User::all()->random()->id,
            'user_receiving_id' => User::all()->random()->id,
            'chat_id' => Chat::all()->random()->id,
            'task_id' => Task::all()->random()->id,
        ];
    }
}
