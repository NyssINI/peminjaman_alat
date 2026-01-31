<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'peminjam',
        ]);
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login menggunakan akun Anda.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
           \App\Models\Logaktivitas::catat('LOGIN', 'User berhasil masuk ke sistem');
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->role === 'admin' || $user->role === 'petugas') {
                return redirect()->route('users.index')
                    ->with('success', 'Login berhasil sebagai ' . ucfirst($user->role));
            } else {
                return redirect()->route('peminjam.index')
                    ->with('success', 'Login berhasil sebagai Peminjam');
            }
        }
        return back()->with('error', 'Email atau password salah!');
    }
    public function logout(Request $request)
    {
        \App\Models\Logaktivitas::catat('LOGOUT', 'User keluar dari sistem');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Berhasil logout');
    }
}
