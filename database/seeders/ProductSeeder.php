<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get seller IDs
        $sellers = User::where('is_seller', true)->get();
        
        if ($sellers->count() == 0) {
            // If no sellers found, run the SellerSeeder first
            $this->call(SellerSeeder::class);
            $sellers = User::where('is_seller', true)->get();
        }
        
        // Sample products
        $products = [
            [
                'name' => 'OG Kush',
                'description' => 'A classic strain with a strong earthy, pine scent and relaxing effects.',
                'price' => 15.99,
                'image' => 'og_kush.jpg',
                'category' => 'Indica',
                'stock' => 100,
            ],
            [
                'name' => 'Blue Dream',
                'description' => 'A sativa-dominant hybrid with sweet berry aroma and balanced effects.',
                'price' => 14.50,
                'image' => 'blue_dream.jpg',
                'category' => 'Hybrid',
                'stock' => 85,
            ],
            [
                'name' => 'Sour Diesel',
                'description' => 'An energizing sativa with a pungent diesel-like aroma.',
                'price' => 16.75,
                'image' => 'sour_diesel.jpg',
                'category' => 'Sativa',
                'stock' => 70,
            ],
            [
                'name' => 'Girl Scout Cookies',
                'description' => 'A popular hybrid with sweet and earthy flavors.',
                'price' => 18.25,
                'image' => 'gsc.jpg',
                'category' => 'Hybrid',
                'stock' => 60,
            ],
            [
                'name' => 'Northern Lights',
                'description' => 'A pure indica with resinous buds and relaxing effects.',
                'price' => 17.50,
                'image' => 'northern_lights.jpg',
                'category' => 'Indica',
                'stock' => 90,
            ],
            [
                'name' => 'Jack Herer',
                'description' => 'A sativa-dominant strain with clear-headed, creative effects.',
                'price' => 16.25,
                'image' => 'jack_herer.jpg',
                'category' => 'Sativa',
                'stock' => 75,
            ],
        ];
        
        // Distribute products among sellers
        foreach ($products as $index => $productData) {
            $sellerId = $sellers[$index % count($sellers)]->id;
            
            Product::create([
                'name' => $productData['name'],
                'description' => $productData['description'],
                'price' => $productData['price'],
                'image' => $productData['image'],
                'category' => $productData['category'],
                'stock' => $productData['stock'],
                'seller_id' => $sellerId,
            ]);
        }
    }
}
