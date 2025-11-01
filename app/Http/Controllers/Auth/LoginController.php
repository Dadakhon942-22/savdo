<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Email manzilini kiriting.',
            'email.email' => 'To\'g\'ri email manzilini kiriting.',
            'password.required' => 'Parolni kiriting.',
            'password.min' => 'Parol kamida 8 ta belgidan iborat bo\'lishi kerak.',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Muvaffaqiyatli kirildi!');
        }

        return back()->withErrors([
            'email' => 'Email yoki parol noto\'g\'ri.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
