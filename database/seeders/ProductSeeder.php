<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'title' => 'Premium Dog Food - Chicken Flavor',
                'description' => 'High-quality dog food made with real chicken, vegetables, and essential nutrients for optimal health and vitality.',
                'image' => 'https://images.unsplash.com/photo-1589941013453-ec89f33b5e95?w=400&h=300&fit=crop',
                'category' => 'Food & Nutrition',
                'price' => 2500,
                'quantity' => 50,
            ],
            [
                'title' => 'Interactive Dog Toy Set',
                'description' => 'Fun and engaging toy set including squeaky balls, chew toys, and puzzle games to keep your dog entertained.',
                'image' => 'https://images.unsplash.com/photo-1601758228041-f3b2795255f1?w=400&h=300&fit=crop',
                'category' => 'Toys & Play',
                'price' => 1200,
                'quantity' => 30,
            ],
            [
                'title' => 'Luxury Pet Bed - Memory Foam',
                'description' => 'Comfortable orthopedic memory foam bed with removable washable cover, perfect for senior pets or those with joint issues.',
                'image' => 'https://images.unsplash.com/photo-1544568100-847a948585b9?w=400&h=300&fit=crop',
                'category' => 'Comfort & Care',
                'price' => 4500,
                'quantity' => 20,
            ],
            [
                'title' => 'Cat Scratching Post Tower',
                'description' => 'Multi-level scratching post with sisal rope, carpeted platforms, and dangling toys for your cat\'s exercise and entertainment.',
                'image' => 'https://images.unsplash.com/photo-1574158622682-e40e69881006?w=400&h=300&fit=crop',
                'category' => 'Toys & Play',
                'price' => 3200,
                'quantity' => 15,
            ],
            [
                'title' => 'Organic Cat Food - Salmon',
                'description' => 'Premium organic cat food with wild-caught salmon, providing essential omega-3 fatty acids and high-quality protein.',
                'image' => 'https://images.unsplash.com/photo-1544568100-847a948585b9?w=400&h=300&fit=crop',
                'category' => 'Food & Nutrition',
                'price' => 1800,
                'quantity' => 40,
            ],
            [
                'title' => 'Pet Grooming Kit Professional',
                'description' => 'Complete grooming kit including brushes, nail clippers, shampoo, and grooming scissors for professional results at home.',
                'image' => 'https://images.unsplash.com/photo-1583337130417-3346a1be7dee?w=400&h=300&fit=crop',
                'category' => 'Comfort & Care',
                'price' => 2800,
                'quantity' => 25,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
