<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // CSRF token'ni yangilash
        return response()->view('auth.login')
            ->header('X-CSRF-TOKEN', csrf_token());
    }

    public function login(Request $request)
    {
        try {
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
        } catch (\Illuminate\Session\TokenMismatchException $e) {
            // CSRF token muammosi
            $request->session()->regenerateToken();
            return redirect()->route('login')->withErrors([
                'email' => 'Sahifa muddati tugagan. Qayta urinib ko\'ring.',
            ]);
        } catch (\Exception $e) {
            \Log::error('Login error: ' . $e->getMessage());
            return back()->withErrors([
                'email' => 'Xatolik yuz berdi. Qayta urinib ko\'ring.',
            ])->withInput($request->only('email'));
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
