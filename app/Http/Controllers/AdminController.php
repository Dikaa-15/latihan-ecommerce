<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function cards()
    {
        $users = User::count();
        $products = Product::count();
        $transactions = Transaction::sum('total_harga');
        $latestTransaction = Transaction::with(['user', 'product']);
        // ->latest()->paginate(10)

        return response()->json([
            'Users' => $users,
            'Products' => $products,
            'Transactions_Total' => $transactions,
            'Latest Transactions' => $latestTransaction
        ]);

        // return view('admin.home', compact('users', 'products', 'transactions', 'latestTransaction'));
    }

    public function profil()
    {
        $user = Auth::user();
        return view('user.profil', compact('user'));
    }

    public function profilUpdateUser(Request $request)
    {
        $user = Auth::user()->role['user'];

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone_number' => 'required|numeric|digits_between:1,25',
            'profil' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        if ($request->hasFile('profil')) {

            $profil = $request->file('profil');
            $profil->storeAs('public/users', $profil->hashName());

            Storage::delete('public/users/' . basename($user->profil));

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'profil' => $profil->hashName()
            ]);
        } else {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
            ]);
        }

        return redirect()->route('profil');
    }
}
