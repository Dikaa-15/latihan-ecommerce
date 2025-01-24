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
        // Validasi input form
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'cart_id' => 'required|integer|exists:carts,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'alamat' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'payment' => 'required|string',
            'bukti_transfer' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048' // Validasi untuk bukti transfer
        ]);

        // Simpan file bukti transfer jika ada
        $buktiTransferPath = null;
        if ($request->hasFile('bukti_transfer')) {
            $buktiTransferPath = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
        }

        $cart_id = Auth::user();

        // Buat data transaksi
        Transaction::create([
            'user_id' => auth()->id(), // ID user yang sedang login
            'product_id' => $request->product_id,
            'cart_id' => $request->cart_id, // Jika transaksi mencakup lebih dari 1 produk, sesuaikan logikanya
            'jumlah' => 1,
            'name' => $request->name, // Default jumlah, bisa diubah sesuai kebutuhan
            'email' => $request->email, // Default jumlah, bisa diubah sesuai kebutuhan
            'alamat' => $request->alamat, // Default jumlah, bisa diubah sesuai kebutuhan
            'phone_number' => $request->phone_number, // Default jumlah, bisa diubah sesuai kebutuhan
            'total_harga' => 0, // Total harga, isi sesuai dengan logika kalkulasi
            'payment' => $request->payment,
            'status' => 'pending', // Default status
            'bukti_transfer' => $buktiTransferPath,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('cart.index')->with('success', 'Transaksi berhasil dibuat!');
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
