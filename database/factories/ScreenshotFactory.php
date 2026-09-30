<?php

namespace Database\Factories;

use App\Models\Screenshot;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Screenshot>
 */
class ScreenshotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'screenshot_path' => 'https://placehold.net/800x600.png',
        ];
    }
}
