<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
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
            //
            'title' => fake()->sentence(6),
            'description' => fake()->optional(0.7)->paragraph(),
            'due_date' => fake()->optional(0.6)->dateTimeBetween('now', '+30 days'),
            'priority' => fake()->randomElement(['low', 'medium', 'high']),
            'completed' => fake()->boolean(20),
            'user_id' => User::factory()
        ];
    }
}
