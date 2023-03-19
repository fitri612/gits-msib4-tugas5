<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Categories;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        
        $products = Products::with('category')->get();

        return view('pages.product.index', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        Products::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
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
            'stock' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('product.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Products $product)
    {
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully!');
    }

    public function getProductsByCategory($category_id)
    {
        $products = Products::where('category_id', $category_id)->pluck('name', 'id');
        return response()->json($products);
    }
}
