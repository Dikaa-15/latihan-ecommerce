<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $user = Auth::user();

        $paymentMethods = ['bca', 'bri', 'bni']; // Opsi enum

        $totalHarga  = $carts->sum(function ($carts) {
            return $carts->product->price * $carts->jumlah;
        });

        return view('carts.index', compact('carts', 'totalHarga', 'user', 'paymentMethods'));
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

        
        Cart::updateOrCreate(
            ['user_id' => Auth::id(), 'product_id' => $request->product_id ],
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

    public function checkOut(Request $request)
    {
        $request->validate([
            'payment' => 'required|string|max:50',
            'bukti_transfer' => 'required|file|mimes:jpg,png,pdf|max:2048',

        ]);

        try {
            // Upload bukti transfer
            $bukti_transfer = $request->file('bukti_transfer')->store('transactions', 'public');

            // Ambil user yang sedang login
            $user = Auth::user();

            // Simpan transaksi
            Transaction::create([
                'user_id' => $user->id,
                'payment' => $request->payment,
                'bukti_transfer' => $bukti_transfer,
                'status' => 'pending', // Status default
            ]);

            return redirect()->route('cart.index')->with('success', 'Checkout berhasil! Transaksi Anda sedang diproses.');
        } catch (\Exception $e) {
            // Tangani error dan tampilkan pesan gagal
            return redirect()->route('home')->with('error', 'Checkout gagal! Silakan coba lagi.');
        }
    }
}
