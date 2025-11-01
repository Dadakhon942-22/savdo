@extends('layouts.app')

@section('title', __('messages.new_product'))

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Hero Section -->
    <div class="relative mb-8 md:mb-12">
        <!-- Pastki oyna -->
        <div class="absolute inset-0 bg-gradient-to-br from-primary-600 via-secondary-600 to-accent-600 rounded-3xl transform rotate-[-1deg] opacity-20 blur-md"></div>
        
        <!-- Asosiy oyna -->
        <div class="relative text-center py-8 md:py-12 px-4 md:px-6 rounded-2xl md:rounded-3xl bg-gradient-to-br from-primary-50 via-secondary-50 to-accent-50 dark:from-primary-900/30 dark:via-secondary-900/30 dark:to-accent-900/30 border-2 border-primary-200 dark:border-primary-700 shadow-xl">
            <div class="relative z-10">
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold mb-3 md:mb-4 bg-gradient-to-r from-primary-600 via-secondary-600 to-accent-600 dark:from-primary-400 dark:via-secondary-400 dark:to-accent-400 bg-clip-text text-transparent drop-shadow-sm">
                    ➕ {{ __('messages.new_product') }}
                </h1>
                <p class="text-base md:text-xl text-slate-700 dark:text-slate-300 font-bold">{{ __('messages.add_new_product') }}</p>
                <p class="text-sm md:text-base text-slate-600 dark:text-slate-400 font-bold mt-2">{{ __('messages.shop') }}: {{ $shop->name }}</p>
            </div>
        </div>
    </div>

    <!-- Pastki oyna -->
    <div class="relative">
        <div class="absolute inset-0 bg-gradient-to-br from-primary-500 via-secondary-500 to-accent-500 rounded-3xl transform rotate-[-1deg] opacity-10 blur-md"></div>
        
        <!-- Asosiy oyna -->
        <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-6 md:p-8 border-2 border-gray-200 dark:border-gray-700">
            <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Mahsulot nomi (tarjimalar) -->
                <div class="relative mb-8">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-400 via-secondary-400 to-accent-400 rounded-2xl transform rotate-[-0.5deg] opacity-5 blur-sm"></div>
                    <div class="relative bg-gradient-to-br from-primary-50 via-secondary-50 to-accent-50 dark:from-gray-900 dark:to-gray-800 rounded-xl p-6 border-2 border-primary-200 dark:border-primary-700">
                        <h3 class="text-xl font-extrabold text-slate-900 dark:text-white mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                            </svg>
                            {{ __('messages.name') }} ({{ __('messages.language') }}) *
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <label for="name_uz" class="block text-base font-extrabold text-slate-900 dark:text-white mb-2">🇺🇿 O'zbekcha *</label>
                                <input type="text" name="name_uz" id="name_uz" required value="{{ old('name_uz', old('name')) }}" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-slate-900 dark:text-white bg-white dark:bg-gray-700 font-bold focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('name_uz') border-red-500 @enderror">
                                @error('name_uz')
                                    <p class="text-red-600 dark:text-red-400 text-sm mt-2 font-extrabold">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="name_ru" class="block text-base font-extrabold text-slate-900 dark:text-white mb-2">🇷🇺 Русский *</label>
                                <input type="text" name="name_ru" id="name_ru" required value="{{ old('name_ru', old('name')) }}" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-slate-900 dark:text-white bg-white dark:bg-gray-700 font-bold focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('name_ru') border-red-500 @enderror">
                                @error('name_ru')
                                    <p class="text-red-600 dark:text-red-400 text-sm mt-2 font-extrabold">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="name_en" class="block text-base font-extrabold text-slate-900 dark:text-white mb-2">🇬🇧 English *</label>
                                <input type="text" name="name_en" id="name_en" required value="{{ old('name_en', old('name')) }}" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-slate-900 dark:text-white bg-white dark:bg-gray-700 font-bold focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('name_en') border-red-500 @enderror">
                                @error('name_en')
                                    <p class="text-red-600 dark:text-red-400 text-sm mt-2 font-extrabold">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kategoriya -->
                <div class="mb-6">
                    <label for="category_id" class="block text-lg font-extrabold text-slate-900 dark:text-white mb-3">{{ __('messages.category') }} *</label>
                    <select name="category_id" id="category_id" required class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-slate-900 dark:text-white bg-white dark:bg-gray-700 font-bold focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('category_id') border-red-500 @enderror">
                        <option value="">{{ __('messages.select_category') }}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->localized_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-600 dark:text-red-400 text-sm mt-2 font-extrabold">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tavsif (tarjimalar) -->
                <div class="relative mb-8">
                    <div class="absolute inset-0 bg-gradient-to-br from-secondary-400 via-accent-400 to-primary-400 rounded-2xl transform rotate-[-0.5deg] opacity-5 blur-sm"></div>
                    <div class="relative bg-gradient-to-br from-secondary-50 via-accent-50 to-primary-50 dark:from-gray-900 dark:to-gray-800 rounded-xl p-6 border-2 border-secondary-200 dark:border-secondary-700">
                        <h3 class="text-xl font-extrabold text-slate-900 dark:text-white mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-secondary-600 dark:text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                            </svg>
                            {{ __('messages.description') }} ({{ __('messages.language') }})
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <label for="description_uz" class="block text-base font-extrabold text-slate-900 dark:text-white mb-2">🇺🇿 O'zbekcha</label>
                                <textarea name="description_uz" id="description_uz" rows="4" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-slate-900 dark:text-white bg-white dark:bg-gray-700 font-medium focus:ring-2 focus:ring-secondary-500 focus:border-secondary-500 @error('description_uz') border-red-500 @enderror">{{ old('description_uz', old('description')) }}</textarea>
                                @error('description_uz')
                                    <p class="text-red-600 dark:text-red-400 text-sm mt-2 font-extrabold">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="description_ru" class="block text-base font-extrabold text-slate-900 dark:text-white mb-2">🇷🇺 Русский</label>
                                <textarea name="description_ru" id="description_ru" rows="4" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-slate-900 dark:text-white bg-white dark:bg-gray-700 font-medium focus:ring-2 focus:ring-secondary-500 focus:border-secondary-500 @error('description_ru') border-red-500 @enderror">{{ old('description_ru', old('description')) }}</textarea>
                                @error('description_ru')
                                    <p class="text-red-600 dark:text-red-400 text-sm mt-2 font-extrabold">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="description_en" class="block text-base font-extrabold text-slate-900 dark:text-white mb-2">🇬🇧 English</label>
                                <textarea name="description_en" id="description_en" rows="4" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-slate-900 dark:text-white bg-white dark:bg-gray-700 font-medium focus:ring-2 focus:ring-secondary-500 focus:border-secondary-500 @error('description_en') border-red-500 @enderror">{{ old('description_en', old('description')) }}</textarea>
                                @error('description_en')
                                    <p class="text-red-600 dark:text-red-400 text-sm mt-2 font-extrabold">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Narx va Omborda -->
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="price" class="block text-lg font-extrabold text-slate-900 dark:text-white mb-3">{{ __('messages.price') }} ({{ __('messages.currency') }}) *</label>
                        <input type="number" name="price" id="price" required step="0.01" value="{{ old('price') }}" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-slate-900 dark:text-white bg-white dark:bg-gray-700 font-extrabold text-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('price') border-red-500 @enderror">
                        @error('price')
                            <p class="text-red-600 dark:text-red-400 text-sm mt-2 font-extrabold">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="stock" class="block text-lg font-extrabold text-slate-900 dark:text-white mb-3">{{ __('messages.stock') }} *</label>
                        <input type="number" name="stock" id="stock" required value="{{ old('stock', 0) }}" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-slate-900 dark:text-white bg-white dark:bg-gray-700 font-extrabold text-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('stock') border-red-500 @enderror">
                        @error('stock')
                            <p class="text-red-600 dark:text-red-400 text-sm mt-2 font-extrabold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Aksiya (Chegirma) -->
                <div class="relative mb-6">
                    <div class="absolute inset-0 bg-gradient-to-br from-orange-500 via-red-500 to-pink-500 rounded-2xl transform rotate-[-0.5deg] opacity-10 blur-sm"></div>
                    <div class="relative bg-gradient-to-r from-orange-50 via-red-50 to-pink-50 dark:from-orange-900/30 dark:via-red-900/30 dark:to-pink-900/30 rounded-xl p-6 border-2 border-orange-200 dark:border-orange-700">
                        <h3 class="text-xl font-extrabold text-slate-900 dark:text-white mb-4 flex items-center">
                            <span class="text-2xl mr-2">🔥</span>
                            Aksiya (Chegirma)
                        </h3>
                        
                        <div class="mb-4">
                            <label class="flex items-center cursor-pointer p-3 bg-white dark:bg-gray-800 rounded-xl border-2 border-gray-200 dark:border-gray-700 hover:border-orange-300 dark:hover:border-orange-600 transition-colors">
                                <input type="checkbox" name="is_on_sale" id="is_on_sale" value="1" {{ old('is_on_sale') ? 'checked' : '' }} class="w-5 h-5 rounded text-orange-600 focus:ring-orange-500">
                                <span class="ml-3 text-base font-extrabold text-slate-900 dark:text-white">Mahsulotni aksiyaga qo'yish</span>
                            </label>
                        </div>

                        <div id="discount_section" style="display: {{ old('is_on_sale') ? 'block' : 'none' }};">
                            <label for="discount_percentage" class="block text-base font-extrabold text-slate-900 dark:text-white mb-3">Chegirma foizi (%)</label>
                            <input type="number" name="discount_percentage" id="discount_percentage" min="0" max="99" step="0.01" value="{{ old('discount_percentage', 0) }}" class="w-full md:w-1/2 border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-slate-900 dark:text-white bg-white dark:bg-gray-700 font-extrabold focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            <p class="text-sm text-slate-600 dark:text-slate-400 mt-2 font-bold">Masalan: 10, 25, 50 va h.k.</p>
                        </div>
                    </div>
                </div>

                <script>
                    document.getElementById('is_on_sale').addEventListener('change', function() {
                        document.getElementById('discount_section').style.display = this.checked ? 'block' : 'none';
                        if (!this.checked) {
                            document.getElementById('discount_percentage').value = 0;
                        }
                    });
                </script>

                <!-- Rasm -->
                <div class="relative mb-6">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-400 via-purple-400 to-pink-400 rounded-2xl transform rotate-[-0.5deg] opacity-5 blur-sm"></div>
                    <div class="relative bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:to-gray-800 rounded-xl p-6 border-2 border-blue-200 dark:border-blue-700">
                        <label for="image" class="block text-lg font-extrabold text-slate-900 dark:text-white mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ __('messages.image') }}
                        </label>
                        <div class="flex items-center space-x-4">
                            <div class="flex-1">
                                <input type="file" name="image" id="image" accept="image/*" class="w-full border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 bg-white dark:bg-gray-700 text-slate-900 dark:text-white font-bold focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('image') border-red-500 @enderror">
                                @error('image')
                                    <p class="text-red-600 dark:text-red-400 text-sm mt-2 font-extrabold">{{ $message }}</p>
                                @enderror
                                <p class="text-xs text-slate-600 dark:text-slate-400 mt-2 font-bold">JPG, PNG yoki WEBP format (maks. 2MB)</p>
                            </div>
                            <div id="image-preview" class="hidden">
                                <img id="preview-img" src="" alt="Preview" class="w-20 h-20 object-cover rounded-xl border-2 border-gray-300 dark:border-gray-600 shadow-md">
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

                <!-- Faol holati -->
                <div class="mb-6 p-4 bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-900/30 dark:to-green-900/30 rounded-xl border-2 border-emerald-200 dark:border-emerald-700">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="w-5 h-5 rounded text-emerald-600 focus:ring-emerald-500">
                        <span class="ml-3 text-base font-extrabold text-slate-900 dark:text-white">{{ __('messages.active') }}</span>
                    </label>
                </div>

                <!-- Tugmalar -->
                <div class="flex gap-4">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 text-white px-8 py-4 rounded-xl font-extrabold text-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        {{ __('messages.save') }}
                    </button>
                    <a href="{{ route('seller.products.index') }}" class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-slate-900 dark:text-white px-8 py-4 rounded-xl font-extrabold shadow-lg transition-all duration-300">
                        {{ __('messages.cancel') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
