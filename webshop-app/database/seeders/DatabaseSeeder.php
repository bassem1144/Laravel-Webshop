<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\user;
use App\Models\products;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        products::create([
            'name' => 'Product 1',
            'price' => 100,
            'description' => 'This is product 1'
        ]);

        products::create([
            'name' => 'Product 2',
            'price' => 200,
            'description' => 'This is product 2'
        ]);

        products::create([
            'name' => 'Product 3',
            'price' => 300,
            'description' => 'This is product 3'
        ]);

        products::create([
            'name' => 'Product 4',
            'price' => 400,
            'description' => 'This is product 4'
        ]);

        products::create([
            'name' => 'Product 5',
            'price' => 500,
            'description' => 'This is product 5'
        ]);

        products::create([
            'name' => 'Product 6',
            'price' => 600,
            'description' => 'This is product 6'
        ]);

        user::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => 'admin'
        ]);
    }
}
