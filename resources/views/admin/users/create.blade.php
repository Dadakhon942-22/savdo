@extends('layouts.app')

@section('title', 'Yangi Foydalanuvchi')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-8 text-gray-900 dark:text-white">➕ Yangi Foydalanuvchi Qo'shish</h1>

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="name" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Ism *</label>
                <input type="text" name="name" id="name" required value="{{ old('name') }}" 
                    class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Email *</label>
                <input type="email" name="email" id="email" required value="{{ old('email') }}" 
                    class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="role" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Rol *</label>
                <select name="role" id="role" required 
                    class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                    <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>👤 Xaridor</option>
                    <option value="seller" {{ old('role') == 'seller' ? 'selected' : '' }}>🏪 Sotuvchi</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>👑 Admin</option>
                </select>
                @error('role')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl border border-blue-200 dark:border-blue-700">
                <h3 class="text-lg font-semibold text-blue-700 dark:text-blue-300 mb-4">🔐 Parol</h3>
                
                <div class="mb-4">
                    <label for="password" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Parol *</label>
                    <input type="password" name="password" id="password" required
                        class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1 font-medium">Kamida 6 ta belgi</p>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Parolni Tasdiqlang *</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 text-white px-8 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300">
                    💾 Saqlash
                </button>
                <a href="{{ route('admin.users.index') }}" class="bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-white px-8 py-3 rounded-xl font-bold hover:bg-gray-400 dark:hover:bg-gray-500 transition-all duration-300">
                    ❌ Bekor qilish
                </a>
            </div>
        </form>
    </div>
</div>
@endsection



