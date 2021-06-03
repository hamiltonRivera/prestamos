<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create([
            'name' => 'José Mendible',
            'email' => 'test@test.com',
            'email_verified_at' => now(),
            'password' => bcrypt('test-2020'), // password
            'remember_token' => Str::random(10),
        ]);
    }
}
