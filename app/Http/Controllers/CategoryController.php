<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Categories;

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
}
