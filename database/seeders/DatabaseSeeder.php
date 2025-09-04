<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call our seeders in the correct order
        $this->call([
            UserSeeder::class,     // Create regular users and admin
            SellerSeeder::class,   // Create sellers
            ProductSeeder::class,  // Create products
        ]);
    }
}
