<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['guest', 'user', 'fat', 'procurement', 'logistik'];

        foreach ($roles as $role) {
            User::firstOrCreate([
                'email' => $role . '@example.com',
            ], [
                'name' => ucfirst($role) . ' User',
                'password' => Hash::make('password'),
                'role' => $role,
            ]);
            
        }
    }
}
