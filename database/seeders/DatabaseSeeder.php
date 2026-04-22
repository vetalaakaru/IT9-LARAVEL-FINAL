<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Run the Admin Seeder first
        $this->call(AdminSeeder::class);

       
        User::factory()->seller()->create([
            'name' => 'Espifior Admin',
            'email' => 'merchant@example.com',
            'password' => bcrypt('password123'),
            'role' => 'seller', // Match migration
            'status' => 'active',
        ]);

        // 3. Create a default Buyer to test the CraveCart shop
        User::factory()->create([
            'name' => 'Regular Buyer',
            'email' => 'buyer@example.com',
            'password' => bcrypt('password123'),
            'role' => 'buyer',
            'status' => 'active',
        ]);

        User::factory(10)->create([
            'role' => 'buyer'
        ]);
    }
}