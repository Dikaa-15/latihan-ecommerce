<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function cards()
    {
        $users = User::count();
        $products = Product::count();

        return view('admin.home', compact('users', 'products'));
    }
    public function customers()
    {
        $users = User::latest()->paginate(10);
        return view('admin.customers', compact('users'));
    }
    public function deleteCustomer($id)
    {
        $user = User::find($id);

        Storage::delete('public/users/' . basename($user->profil));

        $user->delete();

        return view('admin.customers');
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
