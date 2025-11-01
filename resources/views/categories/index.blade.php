@extends('layouts.app')

@section('title', __('messages.categories'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Section -->
    <div class="mb-10">
        <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-gray-900 dark:text-white mb-4">
            {{ __('messages.categories') }}
        </h1>
        <p class="text-xl md:text-2xl text-gray-700 dark:text-gray-300 font-medium">
            Mahsulotlarimizni kategoriyalar bo'yicha ko'ring
        </p>
    </div>

    <!-- Kategoriyalar Navbar (Sahifa ichida) -->
    @if($categories->count() > 0)
    <div class="mb-12">
        <div class="relative">
            <!-- Pastki oyna -->
            <div class="absolute inset-0 bg-gradient-to-r from-primary-600 via-secondary-600 to-accent-600 rounded-2xl transform rotate-[-1deg] opacity-20 blur-md"></div>
            
            <!-- Asosiy navbar -->
            <div class="relative bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900 backdrop-blur-lg rounded-2xl shadow-2xl border-2 border-gray-200 dark:border-gray-700 p-6 overflow-x-auto">
                <div class="flex items-center space-x-1 md:space-x-3 lg:space-x-4 min-w-max">
                    <span class="text-gray-900 dark:text-white font-bold text-base md:text-lg whitespace-nowrap mr-3">
                        {{ __('messages.categories') }}:
                    </span>
                    
                    @foreach($categories as $category)
                        <a href="{{ route('categories.show', $category) }}" 
                           class="px-5 py-3 rounded-xl text-sm md:text-base font-bold transition-all duration-300 whitespace-nowrap shadow-md {{ request()->routeIs('categories.show') && request()->route('category') && request()->route('category')->id == $category->id ? 'bg-gradient-to-r from-primary-600 to-secondary-600 text-white shadow-lg shadow-green-500/50 dark:shadow-green-400/50 scale-105 ring-2 ring-primary-300 dark:ring-primary-600' : 'bg-white dark:bg-gray-700 text-gray-900 dark:text-white hover:bg-gradient-to-r hover:from-primary-500 hover:to-secondary-500 hover:text-white hover:shadow-lg hover:scale-105 border-2 border-gray-200 dark:border-gray-600' }}">
                            <span class="flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                <span class="font-bold">{{ $category->localized_name }}</span>
                                @if($category->products_count > 0)
                                    <span class="bg-white/30 dark:bg-black/30 px-2.5 py-1 rounded-full text-xs font-extrabold backdrop-blur-sm">
                                        {{ $category->products_count }}
                                    </span>
                                @endif
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Kategoriya kartalari -->
    @if($categories->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 lg:gap-8">
        @foreach($categories as $index => $category)
        <a href="{{ route('categories.show', $category) }}" class="group relative">
            <!-- Asosiy karta (pastda) -->
            <div class="absolute inset-0 bg-gradient-to-br from-primary-600 via-secondary-600 to-accent-600 rounded-3xl transform rotate-[-2deg] opacity-20 group-hover:opacity-30 transition-all duration-300 group-hover:rotate-[-3deg] blur-sm"></div>
            
            <!-- Ikkinchi karta (o'rtada) -->
            <div class="absolute inset-0 bg-gradient-to-br from-primary-400 via-secondary-400 to-accent-400 rounded-3xl transform rotate-[-1deg] opacity-30 group-hover:opacity-40 transition-all duration-300 group-hover:rotate-[-2deg] blur-xs -z-10"></div>
            
            <!-- Asosiy karta (yuqorida) -->
            <div class="relative bg-white dark:bg-gray-800 rounded-3xl shadow-2xl overflow-hidden transform transition-all duration-500 group-hover:scale-105 group-hover:-translate-y-2 border-2 border-gray-200 dark:border-gray-700">
                <!-- Rasm bo'limi -->
                <div class="relative h-56 overflow-hidden bg-gradient-to-br from-primary-500 via-secondary-500 to-accent-500">
                    @if($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->localized_name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500">
                            <svg class="w-32 h-32 text-white opacity-90 group-hover:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                    @endif
                    <!-- Gradient overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                
                <!-- Kontent bo'limi -->
                <div class="p-6 bg-white dark:bg-gray-800">
                    <h3 class="text-xl md:text-2xl font-extrabold text-gray-900 dark:text-white mb-3 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">
                        {{ $category->localized_name }}
                    </h3>
                    @if($category->localized_description)
                        <p class="text-gray-700 dark:text-gray-300 text-sm md:text-base mb-4 line-clamp-2 leading-relaxed font-medium">
                            {{ $category->localized_description }}
                        </p>
                    @endif
                    
                    <div class="flex items-center justify-between pt-4 border-t-2 border-gray-200 dark:border-gray-700">
                        <div class="flex items-center text-primary-600 dark:text-primary-400">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            <span class="font-extrabold text-lg text-gray-900 dark:text-white">{{ $category->products_count }}</span>
                        </div>
                        <div class="flex items-center text-gray-700 dark:text-gray-300 text-sm font-bold group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">
                            <span>{{ __('messages.view') }}</span>
                            <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Shine effect -->
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
            </div>
        </a>
        @endforeach
    </div>
    @else
    <div class="text-center py-20 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900 rounded-3xl shadow-2xl border-2 border-gray-200 dark:border-gray-700">
        <svg class="w-28 h-28 mx-auto text-gray-400 dark:text-gray-500 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
        </svg>
        <p class="text-gray-700 dark:text-gray-300 text-2xl font-bold">{{ __('messages.no_categories') }}</p>
    </div>
    @endif
</div>
@endsection
