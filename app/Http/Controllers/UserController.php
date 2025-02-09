<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function profil()
    {
        $user = Auth::user();
        return response()->json($user, 201);
        // return view('user.profil', compact('user'));
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
