<?php

namespace Database\Factories;

use App\Models\Instructor;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'instructor_id' => Instructor::factory(),
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(5),
            'price' => fake()->randomFloat(2, 49, 199),
            'thumbnail_url' => 'https://picsum.photos/seed/'.fake()->word().'/800/600',
            'difficulty' => fake()->randomElement(['Beginner', 'Intermediate', 'Advanced']),
            'language' => fake()->randomElement(['English', 'Indonesian']),
            'duration_hours' => fake()->randomFloat(1, 2, 40),
            'is_bestseller' => fake()->boolean(20),
            'certificate_included' => true,
        ];
    }
}
