<?php

namespace App\Http\Controllers;

use App\Models\Carts;
use App\Models\Categories;
use App\Models\Products;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        $carts = Carts::with('product')->get();
        $products = Products::with('category')->get();

        return view('pages.cart.index', compact('categories', 'products', 'carts'));
    }
}
