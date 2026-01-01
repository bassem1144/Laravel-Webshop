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
        $laptops = Category::create(['name' => 'Laptops', 'description' => 'High-performance laptops for work and gaming']);
        $keyboards = Category::create(['name' => 'Keyboards', 'description' => 'Mechanical and wireless keyboards']);
        $playstations = Category::create(['name' => 'Playstations', 'description' => 'PlayStation consoles, games and accessories']);
        $headsets = Category::create(['name' => 'Headsets', 'description' => 'Gaming and professional headsets']);
        $monitors = Category::create(['name' => 'Monitors', 'description' => 'High-resolution monitors and displays']);

        // Laptops
        $laptops_data = [
            ['name' => 'Dell XPS 15', 'price' => 149900, 'description' => 'Premium laptop with Intel i7, 16GB RAM, 512GB SSD, 15.6" 4K display', 'stock' => 12],
            ['name' => 'MacBook Pro 14"', 'price' => 199900, 'description' => 'Apple M3 Pro chip, 18GB RAM, 512GB SSD, Liquid Retina XDR display', 'stock' => 8],
            ['name' => 'HP Pavilion Gaming', 'price' => 89900, 'description' => 'Gaming laptop with RTX 3050, Intel i5, 16GB RAM, 512GB SSD', 'stock' => 15],
            ['name' => 'Lenovo ThinkPad X1', 'price' => 169900, 'description' => 'Business laptop with Intel i7, 16GB RAM, 1TB SSD, 14" display', 'stock' => 10],
            ['name' => 'ASUS ROG Strix', 'price' => 179900, 'description' => 'High-end gaming laptop with RTX 4060, Ryzen 9, 32GB RAM, 1TB SSD', 'stock' => 7],
            ['name' => 'Acer Swift 3', 'price' => 69900, 'description' => 'Lightweight ultrabook with Intel i5, 8GB RAM, 256GB SSD', 'stock' => 20],
        ];

        // Keyboards
        $keyboards_data = [
            ['name' => 'Logitech MX Keys', 'price' => 9900, 'description' => 'Wireless illuminated keyboard with smart backlighting', 'stock' => 35],
            ['name' => 'Razer BlackWidow V3', 'price' => 12900, 'description' => 'Mechanical gaming keyboard with Green switches and RGB', 'stock' => 25],
            ['name' => 'Corsair K70 RGB', 'price' => 14900, 'description' => 'Premium mechanical keyboard with Cherry MX switches', 'stock' => 18],
            ['name' => 'Keychron K2', 'price' => 7900, 'description' => 'Wireless mechanical keyboard with hot-swappable switches', 'stock' => 30],
            ['name' => 'SteelSeries Apex Pro', 'price' => 17900, 'description' => 'Adjustable mechanical switches with OLED display', 'stock' => 12],
            ['name' => 'Ducky One 2 Mini', 'price' => 10900, 'description' => '60% compact mechanical keyboard with Cherry MX switches', 'stock' => 22],
        ];

        // Playstations
        $playstations_data = [
            ['name' => 'PlayStation 5', 'price' => 49900, 'description' => 'Next-gen gaming console with 825GB SSD and DualSense controller', 'stock' => 15],
            ['name' => 'PlayStation 5 Digital', 'price' => 39900, 'description' => 'Digital edition without disc drive, 825GB SSD', 'stock' => 10],
            ['name' => 'DualSense Controller', 'price' => 6900, 'description' => 'Wireless controller with haptic feedback and adaptive triggers', 'stock' => 50],
            ['name' => 'PlayStation VR2', 'price' => 54900, 'description' => 'Next-gen VR headset with 4K HDR and eye tracking', 'stock' => 8],
            ['name' => 'PS5 Charging Station', 'price' => 2900, 'description' => 'Dual controller charging dock for DualSense controllers', 'stock' => 40],
            ['name' => 'Spider-Man 2', 'price' => 6999, 'description' => 'Action-adventure game featuring Peter Parker and Miles Morales', 'stock' => 60],
            ['name' => "God of War Ragnarök", 'price' => 6999, 'description' => 'Epic Norse mythology adventure with Kratos and Atreus', 'stock' => 55],
        ];

        // Headsets
        $headsets_data = [
            ['name' => 'Sony WH-1000XM5', 'price' => 34900, 'description' => 'Premium noise-canceling headphones with 30-hour battery', 'stock' => 20],
            ['name' => 'SteelSeries Arctis 7', 'price' => 14900, 'description' => 'Wireless gaming headset with DTS Headphone:X v2.0', 'stock' => 25],
            ['name' => 'HyperX Cloud II', 'price' => 9900, 'description' => 'Gaming headset with 7.1 surround sound and memory foam', 'stock' => 35],
            ['name' => 'Razer BlackShark V2', 'price' => 9900, 'description' => 'Esports gaming headset with THX Spatial Audio', 'stock' => 28],
            ['name' => 'Logitech G Pro X', 'price' => 12900, 'description' => 'Professional gaming headset with Blue VO!CE technology', 'stock' => 18],
            ['name' => 'Bose QuietComfort 45', 'price' => 32900, 'description' => 'Noise-canceling headphones with legendary sound quality', 'stock' => 15],
        ];

        // Monitors
        $monitors_data = [
            ['name' => 'Samsung Odyssey G7', 'price' => 59900, 'description' => '32" curved gaming monitor, 240Hz, 1ms, QLED, 1440p', 'stock' => 10],
            ['name' => 'LG UltraGear 27"', 'price' => 34900, 'description' => '27" IPS gaming monitor, 144Hz, 1ms, HDR10, 1440p', 'stock' => 18],
            ['name' => 'Dell UltraSharp 27"', 'price' => 44900, 'description' => '27" 4K monitor with USB-C, IPS, 99% sRGB', 'stock' => 12],
            ['name' => 'ASUS TUF Gaming 24"', 'price' => 19900, 'description' => '24" Full HD gaming monitor, 165Hz, 1ms, FreeSync', 'stock' => 25],
            ['name' => 'BenQ PD2700U', 'price' => 49900, 'description' => '27" 4K designer monitor with IPS, 100% sRGB, USB-C', 'stock' => 14],
            ['name' => 'AOC 24G2', 'price' => 17900, 'description' => '24" budget gaming monitor, 144Hz, IPS, FreeSync', 'stock' => 30],
        ];

        // Insert all products
        foreach ($laptops_data as $product) {
            Product::create(array_merge($product, ['category_id' => $laptops->id]));
        }

        foreach ($keyboards_data as $product) {
            Product::create(array_merge($product, ['category_id' => $keyboards->id]));
        }

        foreach ($playstations_data as $product) {
            Product::create(array_merge($product, ['category_id' => $playstations->id]));
        }

        foreach ($headsets_data as $product) {
            Product::create(array_merge($product, ['category_id' => $headsets->id]));
        }

        foreach ($monitors_data as $product) {
            Product::create(array_merge($product, ['category_id' => $monitors->id]));
        }

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
