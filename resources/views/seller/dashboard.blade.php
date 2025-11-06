@extends('layouts.app')

@section('title', __('messages.my_shop'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="relative mb-8 md:mb-12">
        <div class="absolute inset-0 bg-gradient-to-br from-primary-600 via-secondary-600 to-accent-600 rounded-3xl transform rotate-[-1deg] opacity-20 blur-md"></div>
        <div class="relative text-center py-8 md:py-12 px-4 md:px-6 rounded-2xl md:rounded-3xl bg-gradient-to-br from-primary-50 via-secondary-50 to-accent-50 dark:from-primary-900/30 dark:via-secondary-900/30 dark:to-accent-900/30 border-2 border-primary-200 dark:border-primary-700 shadow-xl">
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold mb-3 md:mb-4 bg-gradient-to-r from-primary-600 via-secondary-600 to-accent-600 dark:from-primary-400 dark:via-secondary-400 dark:to-accent-400 bg-clip-text text-transparent drop-shadow-sm">
                🏪 {{ __('messages.my_shop') }}
            </h1>
            <p class="text-base md:text-xl text-slate-700 dark:text-slate-300 font-bold">{{ __('messages.shop') }}: {{ $shop->name }}</p>
        </div>
    </div>

    <!-- Kategoriyalar va Mahsulotlar Boshqarish Kartalari -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 md:mb-12">
        <!-- Kategoriyalar Bo'limi -->
        <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500 via-indigo-500 to-purple-500 rounded-2xl transform rotate-[-1deg] opacity-10 blur-sm"></div>
            <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-6 border-2 border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white">📁 {{ __('messages.categories') }}</h2>
                    <span class="text-3xl font-extrabold text-blue-600 dark:text-blue-400">{{ $categories->count() }}</span>
                </div>
                <a href="{{ route('seller.categories.index') }}" class="block bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 hover:from-blue-700 hover:via-indigo-700 hover:to-purple-700 text-white px-6 py-4 rounded-xl text-center font-extrabold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02]">
                    {{ __('messages.manage_categories') }}
                </a>
            </div>
        </div>

        <!-- Mahsulotlar Bo'limi -->
        <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-br from-green-500 via-emerald-500 to-teal-500 rounded-2xl transform rotate-[-1deg] opacity-10 blur-sm"></div>
            <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-6 border-2 border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white">📦 {{ __('messages.products') }}</h2>
                    <span class="text-3xl font-extrabold text-green-600 dark:text-green-400">{{ $productsTotal }}</span>
                </div>
                <a href="{{ route('seller.products.index') }}" class="block bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600 hover:from-green-700 hover:via-emerald-700 hover:to-teal-700 text-white px-6 py-4 rounded-xl text-center font-extrabold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02]">
                    {{ __('messages.manage_products') }}
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 dark:bg-green-900/40 border-2 border-green-400 dark:border-green-700 text-green-800 dark:text-green-300 px-6 py-4 rounded-xl mb-6 font-bold shadow-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 dark:bg-red-900/40 border-2 border-red-400 dark:border-red-700 text-red-800 dark:text-red-300 px-6 py-4 rounded-xl mb-6 font-bold shadow-lg">
            {{ session('error') }}
        </div>
    @endif
</div>
@endsection

