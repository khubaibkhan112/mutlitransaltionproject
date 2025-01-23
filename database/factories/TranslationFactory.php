<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Translation>
 */
class TranslationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'locale' => fake()->randomElement(['en', 'fr', 'es']),
            'key' => fake()->unique()->word,
            'content' => fake()->sentence,
            'tags' => fake()->randomElement(['mobile', 'desktop', 'web']),
        ];
    }
}
