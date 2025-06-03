<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'address' => 'Jl. Admin Street No. 123',
            'phone' => '081234567890'
        ]);
        
        // Create categories
        $categories = [
            [
                'name' => 'Original Chicken',
                'slug' => 'original-chicken',
                'description' => 'Our classic original fried chicken recipes'
            ],
            [
                'name' => 'Spicy Chicken',
                'slug' => 'spicy-chicken',
                'description' => 'Hot and spicy fried chicken variants'
            ],
            [
                'name' => 'Chicken Combos',
                'slug' => 'chicken-combos',
                'description' => 'Value combo meals with sides and drinks'
            ],
            [
                'name' => 'Sides',
                'slug' => 'sides',
                'description' => 'Delicious sides to complement your meal'
            ]
        ];
        
        foreach ($categories as $category) {
            Category::create($category);
        }
        
        // Create products
        $products = [
            [
                'category_id' => 1,
                'name' => 'Original Fried Chicken (2 pcs)',
                'slug' => 'original-fried-chicken-2pcs',
                'description' => 'Two pieces of our crispy fried chicken with secret herbs and spices',
                'price' => 25000,
                'image' => 'products/original-2pcs.jpg',
                'is_promo' => false,
                'discount_percentage' => null
            ],
            [
                'category_id' => 1,
                'name' => 'Original Fried Chicken (5 pcs)',
                'slug' => 'original-fried-chicken-5pcs',
                'description' => 'Five pieces of our crispy fried chicken with secret herbs and spices',
                'price' => 60000,
                'image' => 'products/original-5pcs.jpg',
                'is_promo' => true,
                'discount_percentage' => 15
            ],
            [
                'category_id' => 2,
                'name' => 'Spicy Fried Chicken (2 pcs)',
                'slug' => 'spicy-fried-chicken-2pcs',
                'description' => 'Two pieces of our spicy fried chicken with fiery spices',
                'price' => 27000,
                'image' => 'products/spicy-2pcs.jpg',
                'is_promo' => false,
                'discount_percentage' => null
            ],
            [
                'category_id' => 2,
                'name' => 'Extra Spicy Fried Chicken (2 pcs)',
                'slug' => 'extra-spicy-fried-chicken-2pcs',
                'description' => 'Two pieces of our extra spicy fried chicken for brave souls',
                'price' => 29000,
                'image' => 'products/extra-spicy-2pcs.jpg',
                'is_promo' => true,
                'discount_percentage' => 10
            ],
            [
                'category_id' => 3,
                'name' => 'Family Bucket (8 pcs)',
                'slug' => 'family-bucket-8pcs',
                'description' => 'Eight pieces of mixed original and spicy chicken',
                'price' => 95000,
                'image' => 'products/family-bucket.jpg',
                'is_promo' => true,
                'discount_percentage' => 20
            ],
            [
                'category_id' => 3,
                'name' => 'Chicken Combo A',
                'slug' => 'chicken-combo-a',
                'description' => '2 pieces chicken, 1 rice, 1 regular drink',
                'price' => 35000,
                'image' => 'products/combo-a.jpg',
                'is_promo' => false,
                'discount_percentage' => null
            ],
            [
                'category_id' => 4,
                'name' => 'French Fries',
                'slug' => 'french-fries',
                'description' => 'Crispy golden french fries',
                'price' => 15000,
                'image' => 'products/fries.jpg',
                'is_promo' => false,
                'discount_percentage' => null
            ],
            [
                'category_id' => 4,
                'name' => 'Mashed Potato',
                'slug' => 'mashed-potato',
                'description' => 'Creamy mashed potato with gravy',
                'price' => 12000,
                'image' => 'products/mashed-potato.jpg',
                'is_promo' => true,
                'discount_percentage' => 15
            ]
        ];
        
        foreach ($products as $product) {
            Product::create($product);
        }
    }
}