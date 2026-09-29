<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->word();

        return [
            'user_id' => 1, // only me
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => fake()->sentence(),
            'excerpt' => fake()->sentences(2, true),
            'features' => [fake()->sentence()], // try kung gagana sya kapag sa json
            'is_published' => fake()->boolean(80),
            'published_at' => fake()->dateTime(),

        ];
    }
}
