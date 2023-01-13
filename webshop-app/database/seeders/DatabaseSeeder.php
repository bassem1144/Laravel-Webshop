<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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


    }
}
