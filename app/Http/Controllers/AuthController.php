<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Register Form
    public function showRegister()
    {
        return view('auth.register');
    }

    // Register Action
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = UserModel::create([
            'username' => $request->username,
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user',
            'status'   => 'active',
        ]);

        Auth::login($user);

        return redirect()->route('frontend.home')->with('success', 'Register Success!');
    }

    // Login Form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Login Action
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('frontend.mangalist')->with('success', 'Login Success!');
        }

        return back()->withErrors([
            'email' => 'Email หรือ Password ไม่ถูกต้อง',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('frontend.home');
    }
}
