<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomersController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);

        return response()->json(['message' => 'List Customer', $users],200);

        // return view('admin.customers', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::find($id);

        Storage::delete('public/users/' . basename($user->profil));

        $user->delete();

        return response()->json(['message' => 'Data berhasil dihapus',],200);

        return view('admin.customers');
    }
}
