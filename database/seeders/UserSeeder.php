<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        User::create([
            'username' => 'admin',
            'password' => Hash::make('password'),
            'is_seller' => false,
            'is_admin' => true,
            'avatar' => 'default.jpg',
            'balance' => 1000.00,
        ]);
        
        // Regular users
        $users = [
            [
                'username' => 'user1',
                'password' => Hash::make('password'),
                'is_seller' => false,
                'is_admin' => false,
                'avatar' => 'default.jpg',
                'balance' => 500.00,
            ],
            [
                'username' => 'user2',
                'password' => Hash::make('password'),
                'is_seller' => false,
                'is_admin' => false,
                'avatar' => 'default.jpg',
                'balance' => 250.00,
            ],
            [
                'username' => 'user3',
                'password' => Hash::make('password'),
                'is_seller' => false,
                'is_admin' => false,
                'avatar' => 'default.jpg',
                'balance' => 100.00,
            ],
        ];
        
        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
