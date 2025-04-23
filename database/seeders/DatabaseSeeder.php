<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'User Admin',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);
        
        User::create([
            'name' => 'FAT Admin',
            'email' => 'fat@example.com',
            'password' => bcrypt('password'),
            'role' => 'fat',
        ]);
        
        User::create([
            'name' => 'Procurement Admin',
            'email' => 'procurement@example.com',
            'password' => bcrypt('password'),
            'role' => 'procurement',
        ]);
        
        User::create([
            'name' => 'Logistik Admin',
            'email' => 'logistik@example.com',
            'password' => bcrypt('password'),
            'role' => 'logistik',
        ]);
        
        User::create([
            'name' => 'Guest User',
            'email' => 'guest@example.com',
            'password' => bcrypt('password'),
            'role' => 'guest',
        ]);
        
        $this->call([
            UserSeeder::class,
            ItemSeeder::class,
        ]);
    }
}
