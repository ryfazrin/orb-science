<?php

namespace Database\Seeders;

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
        // 1. Create a Test Student User
        $student = User::factory()->create([
            'name' => 'Demo Student',
            'email' => 'student@ilmukomputer.com',
            'password' => bcrypt('password'),
            'bio' => 'I love learning new things.',
            'role' => 'student'
        ]);

        // 2. Create Instructors
        $instructors = \App\Models\Instructor::factory(3)->create();

        // 3. Create a Realistic Course
        $realCourse = \App\Models\Course::factory()->create([
            'instructor_id' => $instructors[0]->id,
            'title' => 'Singly Linked Lists deeply explained',
            'description' => 'A comprehensive guide to understanding and implementing Single Linked Lists from scratch.',
            'category' => 'Data Structures',
            'difficulty' => 'Intermediate',
            'language' => 'English',
        ]);

        $m1 = \App\Models\Module::factory()->create(['course_id' => $realCourse->id, 'title' => 'Linked Lists Intro', 'order' => 1]);
        \App\Models\Lesson::factory()->create(['module_id' => $m1->id, 'title' => 'Array vs Linked List', 'duration_minutes' => 10, 'order' => 1, 'type' => 'video']);
        \App\Models\Lesson::factory()->create(['module_id' => $m1->id, 'title' => 'Anatomy of a Node', 'duration_minutes' => 15, 'order' => 2, 'type' => 'article']);
        
        $m2 = \App\Models\Module::factory()->create(['course_id' => $realCourse->id, 'title' => 'Operations', 'order' => 2]);
        \App\Models\Lesson::factory()->create(['module_id' => $m2->id, 'title' => 'Insertion and Deletion', 'duration_minutes' => 25, 'order' => 1, 'type' => 'video']);

        // 4. Create Random Courses
        foreach ($instructors as $instructor) {
            \App\Models\Course::factory(3)->create(['instructor_id' => $instructor->id])->each(function ($course) {
                // For each course, create 2-4 modules
                \App\Models\Module::factory(rand(2, 4))->create(['course_id' => $course->id])->each(function ($module) {
                    // For each module, create 2-5 lessons
                    \App\Models\Lesson::factory(rand(2, 5))->create(['module_id' => $module->id]);
                });
            });
        }

        // 5. Enroll Student in the realistic course + 2 random ones
        \App\Models\Enrollment::factory()->create([
            'user_id' => $student->id,
            'course_id' => $realCourse->id,
            'progress_percentage' => 65
        ]);

        $otherCourses = \App\Models\Course::where('id', '!=', $realCourse->id)->inRandomOrder()->limit(2)->get();
        foreach ($otherCourses as $course) {
            \App\Models\Enrollment::factory()->create([
                'user_id' => $student->id,
                'course_id' => $course->id,
                'progress_percentage' => rand(10, 100)
            ]);
        }
    }
}
