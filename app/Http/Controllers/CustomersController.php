<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
{
    public function index()
    {
        $users = User::get();

        return response()->json($users, 200);

        // return view('admin.customers', compact('users'));
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json(['data' => $user, 200]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8|max:255',
            'phone_number' => 'required|max:255',
            'profil' => 'required|image|mimes:jpg,jpeg,png'
        ]);
        if ($validator->fails()) {
            return response()->json([$validator->errors(), 401]);
        }
        $profil = $request->file('profil');
        $profil->storeAs('public/customers', $profil->hashName());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone_number' => $request->phone_number,
            'role' => 'user',
            'profil' => $profil->hashName()
        ]);

        return response()->json(['message' => 'Create User successfully', 'data' =>  $user, 200]);
    }
    public function update(Request $request, $id)
    {  
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',            // 'password' => 'required|min:8|max:255',
            'profil' => 'required|image|mimes:jpg,jpeg,png',
            'phone_number' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors(), 401]);
        }
        $customer = User::findOrFail($id);

        if ($request->hasFile('profil')) {
            $profil = $request->file('profil');
            $profil->storeAs('public/users', $profil->hashName());

            Storage::delete('public/users/' . basename($customer->profil));

            $customer->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                // 'password' => $request->password,
                'profil' => $profil->hashName()
            ]);
        } else {
            $customer->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                // 'password' => $request->password,
            ]);
        }

        return response()->json(['message' => 'Update Customers successfully', $customer, 200]);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        Storage::delete('public/users/' . basename($user->profil));

        $user->delete();

        return response()->json(['message' => 'Data berhasil dihapus',], 200);

        //  
    }
}
