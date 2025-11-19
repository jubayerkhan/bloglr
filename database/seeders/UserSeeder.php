<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Jubayer Khan',
            'email' => 'jubayer@example.com',
            'password' => Hash::make('1234'),
        ]);

        // Optional: create multiple fake users using factory
        User::factory()->count(5)->create();
    }
}
