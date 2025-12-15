<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ResourceLink>
 */
class ResourceLinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->words(3, true),
            'url' => $this->faker->url(),
            'description' => $this->faker->sentence(),
            'category' => $this->faker->randomElement(['Research', 'Journals', 'E-Books', 'General']),
            'is_active' => true,
            'display_order' => $this->faker->numberBetween(0, 10),
        ];
    }
}
