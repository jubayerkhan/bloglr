<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Blog::class;
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(5),
            'author' => $this->faker->name(),
            'description' => $this->faker->paragraph(4),
            'image' => $this->faker->imageUrl(640, 480, 'blog', true),
            'user_id' => 2,
        ];
    }
}
