<?php

namespace Database\Factories;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Factories\Factory;

class TodoFactory extends Factory
{
    protected $model = Todo::class;

    public function definition(): array
    {
        $completed = $this->faker->boolean(30);
        
        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(2),
            'completed' => $completed,
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
            'due_date' => $this->faker->optional(0.7)->dateTimeBetween('now', '+30 days'),
            'completed_at' => $completed ? $this->faker->dateTimeBetween('-30 days', 'now') : null,
            'user_id' => null, // Will be set in seeder
        ];
    }

    /**
     * Indicate that the todo is completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'completed' => true,
            'completed_at' => now(),
        ]);
    }

    /**
     * Indicate that the todo is high priority.
     */
    public function highPriority(): static
    {
        return $this->state(fn (array $attributes) => [
            'priority' => 'high',
        ]);
    }
}