<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Transaction::with('product')
        ->where('user_id', Auth::id())
        ->where('status', 'pending')
        ->get(); 

        $totalHarga  = $carts->sum(function ($carts) {
            return $carts->product->price * $carts->jumlah;
        });

        return view('carts.index', compact('carts', 'totalHarga'));
    } 

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1', 
            'jumlah' => '1',
            'total_harga'
        ]);

        $product = Product::findOrFail($request->product_id);
        $totalHarga = $product->price * $request->quantity;

        Transaction::updateOrCreate(
            ['user_id' => Auth::id(), 'product_id' => $request->product_id, 'status' => 'pending'],
            ['quantity' => $request->quantity, 'jumlah' => 1, 'total_harga' => $totalHarga]
        );

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    public function update(Request $request, $id)
    {
        $cart = Transaction::findOrFail($id);
        $request->validate(['quantity' => 'required|integer|min:1']);

        $cart->update(['quantity' => $request->quantity]);

        return redirect()->route('cart.index')->with('success', 'Cart updated!');
    }

    public function destroy($id)
    {
        $cart = Transaction::findOrFail($id);
        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }
}
