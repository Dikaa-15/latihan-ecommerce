<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;

class AuthController extends Controller
{
    use ValidatesRequests;
    // public function registerForm()
    // {
    //     return view('auth.register');
    // }
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:8|max:255',
            'phone_number' => 'required|numeric',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone_number' => $request->phone_number,
            'role' => 'user'
        ]);
        // Auth::login($user);
        // $request->session()->regenerate();

        // return redirect()->route('home');
        return response()->json(['message' => 'Register Successfull', 'data' => $user], 201);
    }
    // public function loginForm()
    // {
    //     return view('auth.login');
    // }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|max:255'
        ]);


        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Login Successful',
                'token' => $token,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role
                ]
            ], 200);
        }

        return response()->json(['message' => 'Invalid Credential'], 401);

        // if(Auth::attempt($credential)){
        //     $request->session()->regenerate();

        //     $roles = Auth::user()->role;

        //     if($roles === 'admin'){
        //         return response()->json(['message' => 'Welcome Admin']);
        //     } elseif($roles === 'user'){
        //         return response()->json(['message' => 'Welcome user']);
        //     }

        //     return response()->json(['message' => 'Invalid Credential'], 404);            
        //     // return back()->withErrors([
        //     //     'email' => 'uour record dosnt match with our record'
        //     // ])->onlyInput('email');

        // }

    }

    public function logout(Request $request)
    {

        Auth::logout();

        return response()->json(['message' => 'Succefully Logout']);
    }
}
