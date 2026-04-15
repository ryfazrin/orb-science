<?php

namespace Database\Factories;

use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    public function definition(): array
    {
        $markdownContent = <<<EOT
The study of this topic reveals fascinating insights into how systems interact at scale. By isolating variables, we can trace outputs back to their fundamental triggers.

> **Important Insight:** Always consider edge cases before finalizing your system architecture diagram.

### Core Concepts

Here are the foundational principles you need to remember:
- **Encapsulation:** Keep data protected.
- **Polymorphism:** Allow multiple implementations.
- **Inheritance:** Reuse code effectively.

Here's an example logic flow:
```javascript
function processData(input) {
    if (!input) return null;
    return input.map(item => item * 2);
}
```

Take a moment to review this snippet before moving to the quiz.
EOT;

        return [
            'module_id' => Module::factory(),
            'title' => fake()->sentence(4),
            'type' => fake()->randomElement(['video', 'article', 'quiz']),
            'duration_minutes' => fake()->numberBetween(5, 60),
            'content' => $markdownContent,
            'is_free_preview' => fake()->boolean(10),
            'order' => fake()->numberBetween(1, 10),
        ];
    }
}
