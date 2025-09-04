<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create seller users
        $sellers = [
            [
                'username' => 'seller1',
                'password' => Hash::make('password'),
                'is_seller' => true,
                'is_admin' => false,
                'avatar' => 'seller1.jpg',
                'balance' => 2000.00,
            ],
            [
                'username' => 'seller2',
                'password' => Hash::make('password'),
                'is_seller' => true,
                'is_admin' => false,
                'avatar' => 'seller2.jpg',
                'balance' => 3000.00,
            ],
            [
                'username' => 'seller3',
                'password' => Hash::make('password'),
                'is_seller' => true,
                'is_admin' => false,
                'avatar' => 'seller3.jpg',
                'balance' => 4000.00,
            ],
        ];
        
        foreach ($sellers as $sellerData) {
            User::create($sellerData);
        }
    }
}
