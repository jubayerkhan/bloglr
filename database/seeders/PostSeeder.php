<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        // Generate 10 posts using factory
        Post::factory()->count(10)->create();
    }
}
