<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->slug(),
            'content' => $this->faker->paragraphs(3, true),
            'image_path' => null,
            'is_published' => $this->faker->boolean(80),
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'created_by' => \App\Models\User::factory(),
        ];
    }
}
