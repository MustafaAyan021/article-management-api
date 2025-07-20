<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $language = 'en_US';
        return [
            'name' => fake()->sentence(1),
            'tagable_id' => Article::inRandomOrder()->first()->id,
            'tagable_type' => Article::class,
        ];
    }
}
