<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        // Create 10 blogs
        Blog::factory()->count(10)->create();
    }
}
