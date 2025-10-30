<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('shop')->latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:customer,seller,admin',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        
        User::create($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'Foydalanuvchi yaratildi');
    }

    public function edit(User $user)
    {
        $shops = Shop::all();
        return view('admin.users.edit', compact('user', 'shops'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:customer,seller,admin',
            'shop_id' => 'nullable|exists:shops,id',
        ]);

        // Agar parol berilgan bo'lsa
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'min:6|confirmed',
            ]);
            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'Foydalanuvchi yangilandi');
    }

    public function destroy(User $user)
    {
        // Admin o'zini o'chira olmasin
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Siz o\'zingizni o\'chira olmaysiz');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Foydalanuvchi o\'chirildi');
    }
}
