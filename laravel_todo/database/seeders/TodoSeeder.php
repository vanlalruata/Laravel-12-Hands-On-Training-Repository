<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a test user if none exists
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
            ]
        );

        // Create 20 todos for the test user
        Todo::factory()
            ->count(20)
            ->create(['user_id' => $user->id]);

        // Create some specific todos for demonstration
        Todo::create([
            'title' => 'Complete Laravel 12 Tutorial',
            'description' => 'Finish all 4 days of the Laravel Todo App tutorial',
            'completed' => false,
            'priority' => 'high',
            'due_date' => now()->addDays(3),
            'user_id' => $user->id,
        ]);

        Todo::create([
            'title' => 'Review MVC Concepts',
            'description' => 'Study Model-View-Controller architecture',
            'completed' => true,
            'priority' => 'medium',
            'due_date' => now()->subDays(2),
            'completed_at' => now()->subDays(1),
            'user_id' => $user->id,
        ]);

        $this->command->info('Created 22 todos successfully!');
    }
}