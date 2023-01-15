<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;

class homepagecontroller extends Controller
{
    // Shows home page
    public function index()
    {
        return view('home', ['products' => products::all()]);
    }
}
