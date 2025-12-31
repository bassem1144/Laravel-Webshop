<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create categories
        $computers = Category::create(['name' => 'Computers', 'description' => 'Laptops, desktops and workstations']);
        $peripherals = Category::create(['name' => 'Peripherals', 'description' => 'Mice, keyboards and accessories']);
        $displays = Category::create(['name' => 'Displays', 'description' => 'Monitors and screens']);
        $accessories = Category::create(['name' => 'Accessories', 'description' => 'Cables, hubs and adapters']);

        Product::create([
            'name' => 'Laptop HP EliteBook',
            'price' => 89900,
            'description' => 'Professional laptop with Intel i7, 16GB RAM, 512GB SSD',
            'stock' => 15,
            'category_id' => $computers->id
        ]);

        Product::create([
            'name' => 'Wireless Mouse Logitech',
            'price' => 2900,
            'description' => 'Ergonomic wireless mouse with USB receiver',
            'stock' => 50,
            'category_id' => $peripherals->id
        ]);

        Product::create([
            'name' => 'Mechanical Keyboard RGB',
            'price' => 12900,
            'description' => 'Gaming mechanical keyboard with RGB lighting',
            'stock' => 30,
            'category_id' => $peripherals->id
        ]);

        Product::create([
            'name' => 'Monitor 27" 4K',
            'price' => 34900,
            'description' => 'Ultra HD 4K monitor with HDR support',
            'stock' => 20,
            'category_id' => $displays->id
        ]);

        Product::create([
            'name' => 'USB-C Hub',
            'price' => 4900,
            'description' => 'Multi-port USB-C hub with HDMI and card reader',
            'stock' => 100,
            'category_id' => $accessories->id
        ]);

        Product::create([
            'name' => 'Webcam 1080p',
            'price' => 7900,
            'description' => 'Full HD webcam with auto-focus and built-in mic',
            'stock' => 45,
            'category_id' => $accessories->id
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
