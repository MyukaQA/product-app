<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Mylian Gedhe',
            'email' => 'mylian@gmail.com',
            'password' => bcrypt('hashmicro'),
        ]);
    }
}
