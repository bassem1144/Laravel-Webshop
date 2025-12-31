<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Product::create([
            'name' => 'Laptop HP EliteBook',
            'price' => 89900,
            'description' => 'Professional laptop with Intel i7, 16GB RAM, 512GB SSD',
            'stock' => 15
        ]);

        Product::create([
            'name' => 'Wireless Mouse Logitech',
            'price' => 2900,
            'description' => 'Ergonomic wireless mouse with USB receiver',
            'stock' => 50
        ]);

        Product::create([
            'name' => 'Mechanical Keyboard RGB',
            'price' => 12900,
            'description' => 'Gaming mechanical keyboard with RGB lighting',
            'stock' => 30
        ]);

        Product::create([
            'name' => 'Monitor 27" 4K',
            'price' => 34900,
            'description' => 'Ultra HD 4K monitor with HDR support',
            'stock' => 20
        ]);

        Product::create([
            'name' => 'USB-C Hub',
            'price' => 4900,
            'description' => 'Multi-port USB-C hub with HDMI and card reader',
            'stock' => 100
        ]);

        Product::create([
            'name' => 'Webcam 1080p',
            'price' => 7900,
            'description' => 'Full HD webcam with auto-focus and built-in mic',
            'stock' => 45
        ]);

        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@webshop.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        // Create regular customer
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role' => 'customer'
        ]);
    }
}
