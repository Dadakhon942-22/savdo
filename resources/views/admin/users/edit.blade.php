@extends('layouts.app')

@section('title', 'Foydalanuvchini Tahrirlash')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">✏️ Foydalanuvchini Tahrirlash</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-2">Foydalanuvchi ma'lumotlari va parolini yangilang</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Shaxsiy ma'lumotlar -->
            <div class="p-6 md:p-8 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">📋 Shaxsiy ma'lumotlar</h2>
                
                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Ism *</label>
                        <input type="text" name="name" id="name" required value="{{ old('name', $user->name) }}" 
                            class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Email *</label>
                        <input type="email" name="email" id="email" required value="{{ old('email', $user->email) }}" 
                            class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="role" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Rol *</label>
                        <select name="role" id="role" required 
                            class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all">
                            <option value="customer" {{ old('role', $user->role) == 'customer' ? 'selected' : '' }}>👤 Xaridor</option>
                            <option value="seller" {{ old('role', $user->role) == 'seller' ? 'selected' : '' }}>🏪 Sotuvchi</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>👑 Admin</option>
                        </select>
                        @error('role')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div id="shop_section" style="display: {{ old('role', $user->role) == 'seller' ? 'block' : 'none' }};">
                        <label for="shop_id" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Do'kon (Sotuvchi uchun)</label>
                        <select name="shop_id" id="shop_id" 
                            class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all">
                            <option value="">Do'kon tanlanmagan</option>
                            @foreach($shops as $shop)
                                <option value="{{ $shop->id }}" {{ old('shop_id', $user->shop_id) == $shop->id ? 'selected' : '' }}>
                                    {{ $shop->name }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-1 font-medium">Sotuvchiga do'kon tayinlang</p>
                        @error('shop_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Parolni o'zgartirish -->
            <div class="p-6 md:p-8 bg-gradient-to-br from-primary-50 to-secondary-50 dark:from-gray-700 dark:to-gray-700">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">🔐 Parolni o'zgartirish</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">Bo'sh qoldiring agar parolni o'zgartirmoqchi bo'lmasangiz</p>
                
                <div class="space-y-6">
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Yangi parol</label>
                        <input type="password" name="password" id="password" 
                            class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all">
                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Kamida 6 ta belgi</p>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Yangi parolni tasdiqlash</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" 
                            class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all">
                    </div>
                </div>
            </div>

            <!-- Tugmalar -->
            <div class="p-6 md:p-8 bg-gray-50 dark:bg-gray-900 flex flex-col sm:flex-row gap-4">
                <button type="submit" class="flex-1 bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 text-white px-8 py-4 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Yangilash
                </button>
                <a href="{{ route('admin.users.index') }}" class="flex-1 bg-white dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white px-8 py-4 rounded-xl font-bold hover:bg-gray-100 dark:hover:bg-gray-600 transition-all duration-300 flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Bekor qilish
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('role').addEventListener('change', function() {
        const shopSection = document.getElementById('shop_section');
        shopSection.style.display = this.value === 'seller' ? 'block' : 'none';
        
        // Agar seller bo'lmasa, shop_id ni tozala
        if (this.value !== 'seller') {
            document.getElementById('shop_id').value = '';
        }
    });
</script>
@endsection

