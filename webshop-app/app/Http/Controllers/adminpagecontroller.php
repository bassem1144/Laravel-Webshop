<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;

class adminpagecontroller extends Controller
{
    // Shows admin page
    public function index()
    {
        return view('admin', ['products' => products::all()]);
    }
}
