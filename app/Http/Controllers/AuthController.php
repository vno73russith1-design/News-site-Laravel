<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'login' => 'required|string|min:3|max:50|unique:users,login',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $userRole = Role::where('name', 'user')->firstOrFail();

        User::create([
            'login' => $data['login'],
            'password' => Hash::make($data['password']),
            'role_id' => $userRole->id,
        ]);

        return redirect()->route('login')->with('success', 'Регистрация успешна, войди');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->withErrors(['login' => 'Неверный логин или пароль']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}