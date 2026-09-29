<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Screenshot;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $tags = Tag::factory(10)->create();

        Project::factory(10)
            ->has(Screenshot::factory(3))
            ->create([
                'user_id' => $user->id,
            ])
            ->each(function (Project $project) use ($tags) {
                $project->tags()->attach(
                    $tags->random(fake()->numberBetween(2, 5))
                );
            });
    }
}