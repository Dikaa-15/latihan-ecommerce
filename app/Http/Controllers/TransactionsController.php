<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionsController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['user', 'product'])->get();

        return view('Transactions.index', compact('transactions'));
    }
    public function getMyTrasactions()
    {
        $transactions = Transaction::with('product')
        ->where('user_id', Auth::id())
        ->get();

        $user = Auth::user();

        return view('user.transactions', compact('transactions', 'user'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|in:pending,complete,failed',
        ]);

        // Cari transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($id);

        // Update status
        $transaction->status = $request->status;
        $transaction->save();

        // Redirect kembali ke halaman dengan pesan sukses
        return redirect()->route('transactions.index')->with('success', 'Status transaksi berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);

        return view('Transactions.index');
    }
}
