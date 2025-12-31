<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the homepage with all products
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = Product::paginate(12);
        return view('home', compact('products'));
    }

    /**
     * Display a single product
     *
     * @param Product $product
     * @return \Illuminate\View\View
     */
    public function show(Product $product)
    {
        // Check if product exists (should be handled by route model binding)
        if (!$product || !$product->exists) {
            abort(404, 'Product not found');
        }

        return view('products.show', compact('product'));
    }
}
