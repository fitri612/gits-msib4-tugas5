<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Categories;
use App\Models\Products;
use App\Models\Carts;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $categories = Categories::all();
        $products = null;
    
        if ($request->has('category_id')) {
            $category_id = $request->input('category_id');
            $products = Products::where('category_id', $category_id)->get();
        }
    
        return view('pages.cart.index', compact('categories', 'products'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Products::findOrFail($request->product_id);

        // Check if the product is already in the cart
        $cartItem = Carts::where('product_id', $product->id)->first();

        if ($cartItem) {
            // If the product is already in the cart, update the quantity
            $cartItem->update([
                'qty' => $cartItem->qty + $request->quantity,
            ]);
        } else {
            // If the product is not in the cart, add it
            Carts::create([
                'product_id' => $product->id,
                'qty' => $request->quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function removeFromCart(Carts $cartItem)
    {
        $cartItem->delete();

        return redirect()->back()->with('success', 'Product removed from cart!');
    }
}
