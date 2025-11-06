@extends('layouts.app')

@section('title', __('messages.new_shop_category'))

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Hero Section -->
    <div class="relative mb-8 md:mb-12">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-600 via-purple-600 to-violet-600 rounded-3xl transform rotate-[-1deg] opacity-20 blur-md"></div>
        <div class="relative text-center py-8 md:py-12 px-4 md:px-6 rounded-2xl md:rounded-3xl bg-gradient-to-br from-indigo-50 via-purple-50 to-violet-50 dark:from-indigo-900/30 dark:via-purple-900/30 dark:to-violet-900/30 border-2 border-indigo-200 dark:border-indigo-700 shadow-xl">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold mb-3 md:mb-4 bg-gradient-to-r from-indigo-600 via-purple-600 to-violet-600 dark:from-indigo-400 dark:via-purple-400 dark:to-violet-400 bg-clip-text text-transparent drop-shadow-sm">
                ➕ {{ __('messages.new_shop_category') }}
            </h1>
            <p class="text-base md:text-xl text-slate-700 dark:text-slate-300 font-bold">{{ __('messages.add_new_shop_category') }}</p>
        </div>
    </div>

    <!-- Pastki oyna -->
    <div class="relative">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500 via-purple-500 to-violet-500 rounded-3xl transform rotate-[-1deg] opacity-10 blur-md"></div>
        
        <!-- Asosiy oyna -->
        <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-6 md:p-8 border-2 border-gray-200 dark:border-gray-700">
            <form action="{{ route('admin.shop-categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Category Name -->
                <div class="relative mb-8">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-400 via-purple-400 to-violet-400 rounded-2xl transform rotate-[-0.5deg] opacity-5 blur-sm"></div>
                    <div class="relative bg-gradient-to-br from-indigo-50 via-purple-50 to-violet-50 dark:from-gray-900 dark:to-gray-800 rounded-xl p-6 border-2 border-indigo-200 dark:border-indigo-700">
                        <label for="name" class="block text-lg font-extrabold text-slate-900 dark:text-white mb-3 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                            </svg>
                            {{ __('messages.name') }} *
                        </label>
                        <input type="text" name="name" id="name" required value="{{ old('name') }}" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-slate-900 dark:text-white bg-white dark:bg-gray-700 font-bold focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-red-600 dark:text-red-400 text-sm mt-2 font-extrabold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="relative mb-8">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-400 via-pink-400 to-rose-400 rounded-2xl transform rotate-[-0.5deg] opacity-5 blur-sm"></div>
                    <div class="relative bg-gradient-to-br from-purple-50 via-pink-50 to-rose-50 dark:from-gray-900 dark:to-gray-800 rounded-xl p-6 border-2 border-purple-200 dark:border-purple-700">
                        <label for="description" class="block text-lg font-extrabold text-slate-900 dark:text-white mb-3 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                            </svg>
                            {{ __('messages.description') }}
                        </label>
                        <textarea name="description" id="description" rows="4" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-slate-900 dark:text-white bg-white dark:bg-gray-700 font-medium focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-600 dark:text-red-400 text-sm mt-2 font-extrabold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Image -->
                <div class="relative mb-6">
                    <div class="absolute inset-0 bg-gradient-to-br from-cyan-400 via-blue-400 to-indigo-400 rounded-2xl transform rotate-[-0.5deg] opacity-5 blur-sm"></div>
                    <div class="relative bg-gradient-to-br from-cyan-50 via-blue-50 to-indigo-50 dark:from-gray-900 dark:to-gray-800 rounded-xl p-6 border-2 border-cyan-200 dark:border-cyan-700">
                        <label for="image" class="block text-lg font-extrabold text-slate-900 dark:text-white mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-cyan-600 dark:text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ __('messages.image') }}
                        </label>
                        <input type="file" name="image" id="image" accept="image/*" class="w-full border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 bg-white dark:bg-gray-700 text-slate-900 dark:text-white font-bold focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all @error('image') border-red-500 @enderror">
                        @error('image')
                            <p class="text-red-600 dark:text-red-400 text-sm mt-2 font-extrabold">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-slate-600 dark:text-slate-400 mt-2 font-bold">JPG, PNG yoki WEBP format (maks. 2MB)</p>
                        <div id="image-preview" class="hidden mt-4">
                            <div class="w-32 h-32 bg-gradient-to-br from-gray-100 via-gray-50 to-white dark:from-gray-700 dark:via-gray-800 dark:to-gray-900 rounded-xl border-2 border-gray-300 dark:border-gray-600 shadow-md flex items-center justify-center p-1">
                                <img id="preview-img" src="" alt="Preview" class="max-w-full max-h-full object-contain">
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    document.getElementById('image').addEventListener('change', function(e) {
                        const file = e.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                document.getElementById('preview-img').src = e.target.result;
                                document.getElementById('image-preview').classList.remove('hidden');
                            };
                            reader.readAsDataURL(file);
                        } else {
                            document.getElementById('image-preview').classList.add('hidden');
                        }
                    });
                </script>

                <!-- Tugmalar -->
                <div class="flex gap-4">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-indigo-600 via-purple-600 to-violet-600 hover:from-indigo-700 hover:via-purple-700 hover:to-violet-700 text-white px-8 py-4 rounded-xl font-extrabold text-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        {{ __('messages.save') }}
                    </button>
                    <a href="{{ route('admin.shop-categories.index') }}" class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-slate-900 dark:text-white px-8 py-4 rounded-xl font-extrabold shadow-lg transition-all duration-300">
                        {{ __('messages.cancel') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
