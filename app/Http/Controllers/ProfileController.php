<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        
        // Admin uchun stats
        if ($user->isAdmin()) {
            $orders = \App\Models\Order::with('items')
                ->latest()
                ->take(5)
                ->get();
        } elseif ($user->isCustomer()) {
            // Customer uchun faqat o'z buyurtmalari
            $orders = \App\Models\Order::where('user_id', $user->id)
                ->with('items')
                ->latest()
                ->take(5)
                ->get();
        } else {
            // Seller uchun orders ko'rsatilmaydi
            $orders = collect();
        }
        
        return view('profile.index', compact('user', 'orders'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        // Validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ];

        // Parolni o'zgartirish uchun validation qo'shish (agar maydonlar to'ldirilgan bo'lsa)
        if ($request->filled('current_password') || $request->filled('new_password')) {
            $rules['current_password'] = 'required';
            $rules['new_password'] = ['required', 'confirmed', Password::defaults()];
        }

        $validated = $request->validate($rules);

        // Parolni tekshirish va yangilash
        if ($request->filled('current_password') && $request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => __('messages.current_password_incorrect')])->withInput();
            }
            $validated['password'] = Hash::make($request->new_password);
        }

        // Parolni validated arraydan olib tashlash (agar bor bo'lsa)
        unset($validated['current_password'], $validated['new_password'], $validated['new_password_confirmation']);

        $user->update($validated);

        return redirect()->route('profile.index')
            ->with('success', __('messages.profile_updated'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => __('messages.current_password_incorrect')]);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('profile.index')
            ->with('success', __('messages.password_updated'));
    }
}
