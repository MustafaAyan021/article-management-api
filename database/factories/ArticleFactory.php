<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

use function Pest\Laravel\json;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(5),
            'content' => fake()->text(300),
            'status' => fake()->randomElement(['draft', 'published']),
            'metadata' => [
                'title' => fake()->sentence(5),
                'description' => fake()->paragraph(1),
            ],
            'author_id' => User::inRandomOrder()->first()->id,

        ];
    }
}
