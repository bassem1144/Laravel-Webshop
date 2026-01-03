<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the homepage with all products
     */
    public function index(Request $request): View
    {
        $query = Product::with('category');

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Search by name or description
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price * 100);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price * 100);
        }

        // Sort products
        $sort = $request->get('sort', 'name_asc');
        match($sort) {
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'name_desc' => $query->orderBy('name', 'desc'),
            'newest' => $query->latest(),
            default => $query->orderBy('name', 'asc'),
        };

        $products = $query->paginate(12);
        $categories = Category::withCount('products')->get();

        // Get current category for breadcrumbs
        $currentCategory = null;
        if ($request->filled('category')) {
            $currentCategory = Category::find($request->category);
        }

        return view('home', compact('products', 'categories', 'currentCategory'));
    }

    /**
     * Display a single product
     */
    public function show(Product $product): View
    {
        $product->load('category');

        return view('products.show', compact('product'));
    }
}
