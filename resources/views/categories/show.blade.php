@extends('layouts.app')

@section('title', $category->localized_name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Kategoriya header -->
    <div class="relative mb-12">
        <!-- Pastki oyna -->
        <div class="absolute inset-0 bg-gradient-to-br from-primary-600 via-secondary-600 to-accent-600 rounded-3xl transform rotate-[-1deg] opacity-20 blur-md"></div>
        
        <!-- Asosiy oyna -->
        <div class="relative bg-white dark:bg-gray-800 rounded-3xl shadow-2xl p-8 md:p-12 border-2 border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
                <a href="{{ route('categories.index') }}" class="relative inline-flex items-center bg-gradient-to-r from-primary-50 via-secondary-50 to-accent-50 dark:from-primary-900/30 dark:via-secondary-900/30 dark:to-accent-900/30 hover:from-primary-100 hover:via-secondary-100 hover:to-accent-100 dark:hover:from-primary-900/50 dark:hover:via-secondary-900/50 dark:hover:to-accent-900/50 text-slate-900 dark:text-white hover:text-slate-800 dark:hover:text-gray-100 font-extrabold px-4 py-3 mr-6 rounded-xl border-2 border-primary-200 dark:border-primary-700 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('messages.back') }}
                </a>
                <div class="flex-1">
                    <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white mb-3">{{ $category->localized_name }}</h1>
                    @if($category->localized_description)
                        <p class="text-xl text-gray-700 dark:text-gray-300 font-medium mb-4">{{ $category->localized_description }}</p>
                    @endif
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20 px-4 py-2 rounded-xl">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            <span class="font-extrabold text-lg text-gray-900 dark:text-white">{{ $products->total() }} {{ __('messages.products') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($products->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8" data-grid-responsive>
        @foreach($products as $product)
        <div class="group relative w-full h-full">
            <!-- Pastki oyna -->
            <div class="absolute inset-0 bg-gradient-to-br from-primary-500 via-secondary-500 to-accent-500 rounded-2xl transform rotate-[-2deg] opacity-20 group-hover:opacity-30 transition-all duration-300 group-hover:rotate-[-3deg] blur-sm"></div>
            
            <!-- Asosiy oyna -->
            <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden transform transition-all duration-500 group-hover:scale-105 group-hover:-translate-y-2 border-2 border-gray-200 dark:border-gray-700 h-full flex flex-col">
            <a href="{{ route('products.show', $product) }}">
                @if($product->image)
                    <div class="w-full h-48 bg-gradient-to-br from-gray-100 via-gray-50 to-white dark:from-gray-700 dark:via-gray-800 dark:to-gray-900 flex items-center justify-center">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->localized_name }}" class="max-w-full max-h-full object-contain p-2 group-hover:scale-105 transition-transform duration-500">
                    </div>
                @else
                    <div class="w-full h-48 bg-gradient-to-br from-primary-500 via-secondary-500 to-accent-500 flex items-center justify-center">
                        <svg class="w-20 h-20 text-white opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                @endif
                <div class="p-4 flex-1 flex flex-col">
                    <h3 class="font-extrabold text-lg mb-2 text-gray-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors line-clamp-2">{{ $product->localized_name }}</h3>
                    @if($product->shop)
                        <p class="text-xs text-gray-600 dark:text-gray-400 mb-2 font-medium">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            {{ $product->shop->name }}
                        </p>
                    @endif
                    <p class="text-primary-600 dark:text-primary-400 font-extrabold text-xl mb-2">{{ number_format($product->price, 0, ',', ' ') }} {{ __('messages.currency') }}</p>
                    @if($product->stock > 0)
                        <span class="inline-flex items-center px-2 py-1 bg-green-100 dark:bg-green-900/40 text-green-800 dark:text-green-300 rounded-lg text-xs font-bold mb-auto">
                            {{ __('messages.in_stock', ['count' => $product->stock]) }}
                        </span>
                    @else
                        <span class="inline-flex items-center px-2 py-1 bg-red-100 dark:bg-red-900/40 text-red-800 dark:text-red-300 rounded-lg text-xs font-bold mb-auto">
                            {{ __('messages.out_of_stock') }}
                        </span>
                    @endif
                </div>
            </a>
            @auth
                @if($product->stock > 0)
                <form action="{{ route('cart.store') }}" method="POST" class="p-4 pt-0 mt-auto">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="w-full bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 text-white py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        {{ __('messages.add_to_cart') }}
                    </button>
                </form>
                @endif
            @else
                <div class="p-4 pt-0">
                    <a href="{{ route('login') }}" class="block w-full bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500 text-gray-900 dark:text-white py-3 rounded-xl text-center font-bold transition-colors">
                        {{ __('messages.login') }}
                    </a>
                </div>
            @endauth
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $products->links() }}
    </div>
    @else
    <div class="text-center py-20 bg-white dark:bg-gray-800 rounded-xl shadow-2xl border-2 border-gray-200 dark:border-gray-700">
        <svg class="w-28 h-28 mx-auto text-gray-400 dark:text-gray-500 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
        </svg>
        <p class="text-2xl font-extrabold text-gray-700 dark:text-gray-300">{{ __('messages.no_products') }}</p>
    </div>
    @endif
</div>
@endsection
