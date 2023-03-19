<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Categories;
use App\Models\Products;

class CategoryController extends Controller
{
    //
    public function index(Categories $category)
    {
        $categories = Categories::all();
        return view('pages.category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Categories::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Category added successfully!');
        
    }

    public function edit(Categories $category)
    {
        return view('pages.category.index', compact('category'));
    }

    public function update(Request $request, Categories $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('category.index')->with('success', 'Category updated successfully!');
    }

    public function destroy(Categories $category)
    {

        try {

            $products = Products::where('category_id', $category->id)->get();
            // dd(count($products) >0);
            if (count($products) > 0) {
                return redirect()->back()->with('error', 'Data category ini masih memiliki relasi pada data produk !');
            } else {
                $category->delete();
                return redirect()->back()->with('success', 'Category deleted successfully!');
            }
        } catch (\Exception $error) {
            return redirect()->back()->with('error', $error->getMessage());
        }
    }
}
