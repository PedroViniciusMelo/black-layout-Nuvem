<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Admin  admin',
            'user_name' => 'admin',
            'email' => 'admin@nuvem.com',
            'password' => bcrypt('123456'),
            'phone' => '8799998888',
            'user_type' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::factory()->create([
            'name' => 'Admin Admin',
            'user_name' => 'basic',
            'email' => 'basic@material.com',
            'password' => Hash::make('secret'),
            'phone' => '8799998888',
            'user_type' => 'basic',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::factory()->create([
            'name' => 'Admin Admin',
            'user_name' => 'advanced',
            'email' => 'advanced@material.com',
            'password' => Hash::make('secret'),
            'phone' => '8799998888',
            'user_type' => 'advanced',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
