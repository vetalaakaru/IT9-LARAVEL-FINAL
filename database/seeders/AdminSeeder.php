<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'System Admin',
            'email' => 'admin@cravecart.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'status' => 'active', // Matches the status logic
        ]);
    }
}