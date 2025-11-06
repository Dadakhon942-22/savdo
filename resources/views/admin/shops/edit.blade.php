@extends('layouts.app')

@section('title', __('messages.edit_shop'))

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Hero Section -->
    <div class="relative mb-8 md:mb-12">
        <div class="absolute inset-0 bg-gradient-to-br from-pink-600 via-rose-600 to-red-600 rounded-3xl transform rotate-[-1deg] opacity-20 blur-md"></div>
        <div class="relative text-center py-8 md:py-12 px-4 md:px-6 rounded-2xl md:rounded-3xl bg-gradient-to-br from-pink-50 via-rose-50 to-red-50 dark:from-pink-900/30 dark:via-rose-900/30 dark:to-red-900/30 border-2 border-pink-200 dark:border-pink-700 shadow-xl">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold mb-3 md:mb-4 bg-gradient-to-r from-pink-600 via-rose-600 to-red-600 dark:from-pink-400 dark:via-rose-400 dark:to-red-400 bg-clip-text text-transparent drop-shadow-sm">
                ✏️ {{ __('messages.edit_shop') }}
            </h1>
            <p class="text-base md:text-xl text-slate-700 dark:text-slate-300 font-bold">{{ __('messages.update_shop_info') }}</p>
        </div>
    </div>

    <!-- Pastki oyna -->
    <div class="relative">
        <div class="absolute inset-0 bg-gradient-to-br from-pink-500 via-rose-500 to-red-500 rounded-3xl transform rotate-[-1deg] opacity-10 blur-md"></div>
        
        <!-- Asosiy oyna -->
        <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-6 md:p-8 border-2 border-gray-200 dark:border-gray-700">
            <form action="{{ route('admin.shops.update', $shop) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Shop Owner -->
                <div class="relative mb-8">
                    <div class="absolute inset-0 bg-gradient-to-br from-pink-400 via-rose-400 to-red-400 rounded-2xl transform rotate-[-0.5deg] opacity-5 blur-sm"></div>
                    <div class="relative bg-gradient-to-br from-pink-50 via-rose-50 to-red-50 dark:from-gray-900 dark:to-gray-800 rounded-xl p-6 border-2 border-pink-200 dark:border-pink-700">
                        <label for="user_id" class="block text-lg font-extrabold text-slate-900 dark:text-white mb-3 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-pink-600 dark:text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            {{ __('messages.shop_owner') }} *
                        </label>
                        <select name="user_id" id="user_id" required class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-slate-900 dark:text-white bg-white dark:bg-gray-700 font-bold focus:ring-2 focus:ring-pink-500 focus:border-pink-500 @error('user_id') border-red-500 @enderror">
                            <option value="">{{ __('messages.select_seller') }}</option>
                            @foreach($sellers as $seller)
                                <option value="{{ $seller->id }}" {{ old('user_id', $shop->user_id) == $seller->id ? 'selected' : '' }}>{{ $seller->name }} ({{ $seller->email }})</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="text-red-600 dark:text-red-400 text-sm mt-2 font-extrabold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Shop Category -->
                <div class="relative mb-8">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-400 via-purple-400 to-pink-400 rounded-2xl transform rotate-[-0.5deg] opacity-5 blur-sm"></div>
                    <div class="relative bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:to-gray-800 rounded-xl p-6 border-2 border-indigo-200 dark:border-indigo-700">
                        <label for="shop_category_id" class="block text-lg font-extrabold text-slate-900 dark:text-white mb-3 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            {{ __('messages.shop_category') }} *
                        </label>
                        <select name="shop_category_id" id="shop_category_id" required class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-slate-900 dark:text-white bg-white dark:bg-gray-700 font-bold focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('shop_category_id') border-red-500 @enderror">
                            <option value="">{{ __('messages.select_shop_category') }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('shop_category_id', $shop->shop_category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('shop_category_id')
                            <p class="text-red-600 dark:text-red-400 text-sm mt-2 font-extrabold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Shop Name -->
                <div class="mb-6">
                    <label for="name" class="block text-lg font-extrabold text-slate-900 dark:text-white mb-3">{{ __('messages.shop_name') }} *</label>
                    <input type="text" name="name" id="name" required value="{{ old('name', $shop->name) }}" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-slate-900 dark:text-white bg-white dark:bg-gray-700 font-bold focus:ring-2 focus:ring-pink-500 focus:border-pink-500 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-600 dark:text-red-400 text-sm mt-2 font-extrabold">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="relative mb-8">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-400 via-purple-400 to-pink-400 rounded-2xl transform rotate-[-0.5deg] opacity-5 blur-sm"></div>
                    <div class="relative bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:to-gray-800 rounded-xl p-6 border-2 border-blue-200 dark:border-blue-700">
                        <label for="description" class="block text-lg font-extrabold text-slate-900 dark:text-white mb-3 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                            </svg>
                            {{ __('messages.description') }}
                        </label>
                        <textarea name="description" id="description" rows="4" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-slate-900 dark:text-white bg-white dark:bg-gray-700 font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror">{{ old('description', $shop->description) }}</textarea>
                        @error('description')
                            <p class="text-red-600 dark:text-red-400 text-sm mt-2 font-extrabold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Phone and Address -->
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="phone" class="block text-lg font-extrabold text-slate-900 dark:text-white mb-3">{{ __('messages.phone') }}</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $shop->phone) }}" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-slate-900 dark:text-white bg-white dark:bg-gray-700 font-bold focus:ring-2 focus:ring-pink-500 focus:border-pink-500 @error('phone') border-red-500 @enderror" placeholder="+998901234567">
                        @error('phone')
                            <p class="text-red-600 dark:text-red-400 text-sm mt-2 font-extrabold">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="address" class="block text-lg font-extrabold text-slate-900 dark:text-white mb-3">{{ __('messages.address') }}</label>
                        <textarea name="address" id="address" rows="3" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-slate-900 dark:text-white bg-white dark:bg-gray-700 font-medium focus:ring-2 focus:ring-pink-500 focus:border-pink-500 @error('address') border-red-500 @enderror">{{ old('address', $shop->address) }}</textarea>
                        @error('address')
                            <p class="text-red-600 dark:text-red-400 text-sm mt-2 font-extrabold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Logo -->
                <div class="relative mb-6">
                    <div class="absolute inset-0 bg-gradient-to-br from-yellow-400 via-orange-400 to-pink-400 rounded-2xl transform rotate-[-0.5deg] opacity-5 blur-sm"></div>
                    <div class="relative bg-gradient-to-br from-yellow-50 via-orange-50 to-pink-50 dark:from-gray-900 dark:to-gray-800 rounded-xl p-6 border-2 border-yellow-200 dark:border-yellow-700">
                        <label class="block text-lg font-extrabold text-slate-900 dark:text-white mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ __('messages.logo') }}
                        </label>
                        
                        @if($shop->logo)
                        <div class="mb-4">
                            <label class="block text-base font-bold text-slate-900 dark:text-white mb-2">{{ __('messages.current_image') }}</label>
                            <div class="w-32 h-32 bg-gradient-to-br from-gray-100 via-gray-50 to-white dark:from-gray-700 dark:via-gray-800 dark:to-gray-900 rounded-xl border-2 border-gray-300 dark:border-gray-600 shadow-md flex items-center justify-center p-1">
                                <img src="{{ asset('storage/' . $shop->logo) }}" alt="{{ $shop->name }}" id="current-logo" class="max-w-full max-h-full object-contain">
                            </div>
                        </div>
                        @endif
                        
                        <div>
                            <label for="logo" class="block text-base font-bold text-slate-900 dark:text-white mb-2">{{ __('messages.new_image') }}</label>
                            <input type="file" name="logo" id="logo" accept="image/*" class="w-full border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 bg-white dark:bg-gray-700 text-slate-900 dark:text-white font-bold focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all @error('logo') border-red-500 @enderror">
                            @error('logo')
                                <p class="text-red-600 dark:text-red-400 text-sm mt-2 font-extrabold">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-slate-600 dark:text-slate-400 mt-2 font-bold">JPG, PNG yoki WEBP format (maks. 2MB)</p>
                            <div id="logo-preview" class="hidden mt-4">
                                <div class="w-32 h-32 bg-gradient-to-br from-gray-100 via-gray-50 to-white dark:from-gray-700 dark:via-gray-800 dark:to-gray-900 rounded-xl border-2 border-gray-300 dark:border-gray-600 shadow-md flex items-center justify-center p-1">
                                    <img id="preview-logo" src="" alt="Preview" class="max-w-full max-h-full object-contain">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    document.getElementById('logo').addEventListener('change', function(e) {
                        const file = e.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                document.getElementById('preview-logo').src = e.target.result;
                                document.getElementById('logo-preview').classList.remove('hidden');
                                @if($shop->logo)
                                if (document.getElementById('current-logo')) {
                                    document.getElementById('current-logo').parentElement.classList.add('opacity-50');
                                }
                                @endif
                            };
                            reader.readAsDataURL(file);
                        } else {
                            document.getElementById('logo-preview').classList.add('hidden');
                            @if($shop->logo)
                            if (document.getElementById('current-logo')) {
                                document.getElementById('current-logo').parentElement.classList.remove('opacity-50');
                            }
                            @endif
                        }
                    });
                </script>

                <!-- Active Status -->
                <div class="mb-6 p-4 bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-900/30 dark:to-green-900/30 rounded-xl border-2 border-emerald-200 dark:border-emerald-700">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $shop->is_active) ? 'checked' : '' }} class="w-5 h-5 rounded text-emerald-600 focus:ring-emerald-500">
                        <span class="ml-3 text-base font-extrabold text-slate-900 dark:text-white">{{ __('messages.active') }}</span>
                    </label>
                </div>

                <!-- Tugmalar -->
                <div class="flex gap-4">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-pink-600 via-rose-600 to-red-600 hover:from-pink-700 hover:via-rose-700 hover:to-red-700 text-white px-8 py-4 rounded-xl font-extrabold text-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        {{ __('messages.update') }}
                    </button>
                    <a href="{{ route('admin.shops.index') }}" class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-slate-900 dark:text-white px-8 py-4 rounded-xl font-extrabold shadow-lg transition-all duration-300">
                        {{ __('messages.cancel') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
