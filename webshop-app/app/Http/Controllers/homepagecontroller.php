<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class homepagecontroller extends Controller
{
    public array $products = [
        "Product1" => [
            "name" => "Product1",
            "price" => 100,
            "description" => "This is a product",
            "image" => "https://picsum.photos/200/150"
        ],
        "Product2" => [
            "name" => "Product2",
            "price" => 200,
            "description" => "This is a product",
            "image" => "https://picsum.photos/200/150"
        ],
        "Product3" => [
            "name" => "Product3",
            "price" => 300,
            "description" => "This is a product",
            "image" => "https://picsum.photos/200/150"
        ],
    ];

    public function index()
    {
        return view('home', ['products' => $this->products]);
    }
}
