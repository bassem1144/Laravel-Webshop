<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the homepage with all products
     */
    public function index(): View
    {
        $products = Product::paginate(12);
        return view('home', compact('products'));
    }

    /**
     * Display a single product
     */
    public function show(Product $product): View
    {
        // Check if product exists (should be handled by route model binding)
        if (!$product || !$product->exists) {
            abort(404, 'Product not found');
        }

        return view('products.show', compact('product'));
    }
}
