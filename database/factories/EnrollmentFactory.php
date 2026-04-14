<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnrollmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'course_id' => Course::factory(),
            'enrolled_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'last_accessed_at' => fake()->dateTimeBetween('-1 month', 'now'),
            'progress_percentage' => fake()->numberBetween(0, 100),
            'status' => fake()->randomElement(['active', 'completed']),
        ];
    }
}
