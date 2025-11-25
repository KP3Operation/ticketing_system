<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function actionLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->statusUser == 1) {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('tiket.index');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    
    public function update() {
        return view('auth.change-password');
    }

    public function changePassword(Request $request) {

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with('error', 'Password salah');
        }

        if ($request->new_password != $request->confirm_password) {
            return back()->with('error', 'Password tidak sesuai');
        }

        auth()->user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('status', 'Update Password Berhasil');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
