<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'test@example.com')->first();
        
        if ($user) {
            $categories = [
                ['name' => 'Work', 'color' => '#4f46e5'],
                ['name' => 'Personal', 'color' => '#059669'],
                ['name' => 'Shopping', 'color' => '#dc2626'],
                ['name' => 'Health', 'color' => '#0891b2'],
                ['name' => 'Finance', 'color' => '#d97706'],
            ];

            foreach ($categories as $category) {
                Category::create([
                    'name' => $category['name'],
                    'slug' => \Str::slug($category['name']),
                    'color' => $category['color'],
                    'user_id' => $user->id,
                ]);
            }
        }
    }
}