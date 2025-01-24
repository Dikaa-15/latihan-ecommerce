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

        // Mengirimkan produk pertama dari keranjang (jika ada) ke view
        $product = $carts->first()->product ?? null;


        return view('carts.index', compact('carts', 'totalHarga', 'user', 'paymentMethods', 'product'));
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
            ['user_id' => Auth::id(), 'product_id' => $request->product_id],
            ['quantity' => $request->quantity, 'jumlah' => 1, 'total_harga' => $totalHarga]
        );

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    public function store(Request $request)
    {
        $user = auth()->user(); // User yang sedang login

        // Ambil semua data cart milik user
        $carts = Cart::where('user_id', $user->id)->get();

        if ($carts->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang Anda kosong!');
        }

        // Simpan data transaksi
        foreach ($carts as $cart) {
            Transaction::create([
                'user_id' => $user->id,
                'product_id' => $cart->product_id,
                'jumlah' => $cart->jumlah,
                'total_harga' => $cart->jumlah * $cart->product->price, // Hitung total harga
                'payment' => $request->payment ?? 'cod', // Payment bisa diambil dari input user
                'status' => 'pending',
            ]);
        }

        // Hapus data dari keranjang setelah checkout
        Cart::where('user_id', $user->id)->delete();

        return redirect()->route('carts.index')->with('success', 'Checkout berhasil!');
    }


    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);

        $request->validate(['jumlah' => 'required|integer|min:1']);

        $cart->update(['jumlah' => $request->jumlah]);

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
