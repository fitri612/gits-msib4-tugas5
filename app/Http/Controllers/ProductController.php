<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Categories;

class ProductController extends Controller
{
    public function index()
    {
        // $products = Products::with('categories')->get();
        // $categories = Categories::all();
    
        // return view('pages.product.index', compact('products', 'categories'));
        $products = Products::with('categories')->get();

        return view('pages.product.index', ['products' => $products]);
    }

    public function create()
    {
        $categories = Categories::all();
        return view('pages.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        Products::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        return redirect()->back()->with('success', 'Product added successfully!');
    }

    public function edit(Products $product)
    {
        $categories = Categories::all();
        return view('pages.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Products $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        return redirect()->back()->with('success', 'Product updated successfully!');
    }

    public function destroy(Products $product)
    {
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully!');
    }
}
