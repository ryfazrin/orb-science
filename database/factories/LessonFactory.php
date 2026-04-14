<?php

namespace Database\Factories;

use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    public function definition(): array
    {
        return [
            'module_id' => Module::factory(),
            'title' => fake()->sentence(4),
            'type' => fake()->randomElement(['video', 'article', 'quiz']),
            'duration_minutes' => fake()->numberBetween(5, 60),
            'video_url' => 'https://example.com/video/' . fake()->uuid(),
            'is_free_preview' => fake()->boolean(10),
            'order' => fake()->numberBetween(1, 10),
        ];
    }
}
