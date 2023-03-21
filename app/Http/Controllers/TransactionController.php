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
        $carts = Carts::with('product')->get();
        $products = Products::with('category')->get();

        return view('pages.cart.index', compact('categories', 'products', 'carts'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'qty' => 'required|numeric',
        ]);

        $data = $request->all();

        // Calculating Qty if Cart Exists
        $cart = Carts::where('product_id', $request->product_id)->first();
        $cart ? $data['qty'] += $cart->qty : $data['qty'];


        // Check Product Stock
        $product = Products::findOrFail($request->product_id);
        if ($product->stock < $data['qty']) {
            return redirect()->back()->with('error', 'Out of stock product');
        }

        Carts::updateOrCreate([
            'product_id' => $request->product_id,
        ], $data);

        return redirect()->back()->with('success', 'Product Added to Cart!');
    }

    public function editCart(Carts $cart)
    {
        $categories = Categories::all();
        $products = Products::all();
        return view('pages.cart.edit', compact('categories', 'products', 'cart'));
    }

    public function updateCart(Request $request, Carts $cart)
    {
        $request->validate([
            'qty' => 'required|numeric',
        ]);

        $data = $request->all();

        // Check Product Stock
        $product = $cart->product;
        if ($product->stock < $data['qty']) {
            return redirect()->back()->with('error', 'Out of stock product');
        }

        $cart->update($data);

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
    }

    public function checkout(Request $request)
    {
        $total = $request->input('total');
        $cash = $request->input('cash');
        $change = $cash - $total;

        if ($change < 0) {
            return redirect()->back()->with('error', 'Invalid cash amount.');
        }

        // Lakukan proses checkout / pembayaran di sini
        // Contoh: simpan transaksi ke database, kurangi stok barang, dsb.
        // Kosongkan keranjang belanja

        Carts::truncate();

        return redirect()->route('cart.index')->with('success', 'Transaction successful. Change: Rp. ' . number_format($change));
    }

    public function removeFromCart(Carts $cart)
    {
        $cart->delete();

        return redirect()->back()->with('success', 'Product removed from cart!');
    }
}
