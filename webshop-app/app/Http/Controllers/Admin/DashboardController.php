<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

class DashboardController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function index(): \Illuminate\View\View
    {
        $products = Product::latest()->paginate(15);
        return view('admin.dashboard', compact('products'));
    }
}
