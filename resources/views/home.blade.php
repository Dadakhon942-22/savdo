@extends('layouts.app')

@section('title', 'Bosh sahifa')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Hero Section -->
    <div class="text-center mb-8 md:mb-12 py-8 md:py-12 px-4 md:px-6 rounded-2xl md:rounded-3xl bg-gradient-to-br from-primary-50 via-secondary-50 to-accent-50 dark:from-gray-800 dark:via-gray-800 dark:to-gray-900 border-2 border-primary-100 dark:border-gray-700 shadow-xl">
        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold mb-3 md:mb-4 bg-gradient-to-r from-primary-600 via-secondary-600 to-accent-600 dark:from-primary-400 dark:via-secondary-400 dark:to-accent-400 bg-clip-text text-transparent drop-shadow-sm">
            {{ __('messages.welcome') }}
        </h1>
        <p class="text-base md:text-xl text-gray-800 dark:text-gray-200 font-semibold">{{ __('messages.find_best_products') }}</p>
    </div>

    <!-- Aksiyalar Bo'limi -->
    @if($saleProducts->count() > 0)
    <div class="mb-12 md:mb-16">
        <div class="flex items-center mb-6 md:mb-8">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 dark:text-white flex items-center">
                <span class="bg-gradient-to-r from-accent-600 via-orange-600 to-red-600 dark:from-accent-400 dark:via-orange-400 dark:to-red-400 bg-clip-text text-transparent">
                    🔥 <span class="hidden sm:inline">Aksiya mahsulotlari</span><span class="sm:hidden">Aksiyalar</span>
                </span>
            </h2>
            <div class="flex-1 ml-3 md:ml-4 h-1 bg-gradient-to-r from-accent-200 via-orange-200 to-transparent dark:from-accent-800 dark:via-orange-800 rounded-full"></div>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($saleProducts as $product)
            <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-2xl border-2 border-accent-200 dark:border-accent-700 overflow-hidden transition-all duration-300 hover:-translate-y-2 relative">
                <!-- Chegirma badge -->
                <div class="absolute top-2 right-2 md:top-3 md:right-3 z-10 bg-gradient-to-br from-accent-500 to-red-500 text-white px-2 py-1 md:px-3 md:py-2 rounded-lg md:rounded-xl font-bold text-sm md:text-lg shadow-xl transform rotate-3">
                    -{{ number_format($product->discount_percentage, 0) }}%
                </div>
                
                <a href="{{ route('products.show', $product) }}" class="block">
                    @if($product->image)
                        <div class="relative overflow-hidden h-56">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-black/0 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                    @else
                        <div class="h-56 bg-gradient-to-br from-orange-100 via-red-100 to-pink-100 dark:from-gray-700 dark:via-gray-700 dark:to-gray-600 flex items-center justify-center">
                            <svg class="w-20 h-20 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                    
                    <div class="p-4 md:p-6">
                        <h3 class="font-bold text-lg md:text-xl mb-2 md:mb-3 text-gray-900 dark:text-white line-clamp-2 group-hover:text-accent-600 dark:group-hover:text-accent-400 transition-colors">
                            {{ $product->name }}
                        </h3>
                        
                        <div class="flex items-center text-gray-700 dark:text-gray-300 text-xs md:text-sm mb-2 md:mb-3">
                            <svg class="w-3 h-3 md:w-4 md:h-4 mr-1 md:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            <span class="font-semibold">{{ $product->category->name }}</span>
                        </div>
                        
                        <div class="mb-3 md:mb-4">
                            <!-- Eski narx (chizilgan) -->
                            <p class="text-sm md:text-base text-gray-600 dark:text-gray-400 line-through font-medium">
                                {{ number_format($product->price, 0, ',', ' ') }} {{ __('messages.currency') }}
                            </p>
                            <!-- Yangi narx (chegirmadagi) -->
                            <p class="text-2xl md:text-3xl font-bold text-accent-600 dark:text-accent-400">
                                {{ number_format($product->discounted_price, 0, ',', ' ') }}
                                <span class="text-xs md:text-sm font-normal text-gray-600 dark:text-gray-400">{{ __('messages.currency') }}</span>
                            </p>
                            <p class="text-xs md:text-sm text-secondary-600 dark:text-secondary-400 font-bold mt-1">
                                💰 {{ number_format($product->discount_amount, 0, ',', ' ') }} {{ __('messages.currency') }} tejash!
                            </p>
                        </div>
                        
                        @if($product->stock > 0)
                            <div class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-400">
                                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                {{ __('messages.in_stock', ['count' => $product->stock]) }}
                            </div>
                        @else
                            <div class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-400">
                                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                {{ __('messages.out_of_stock') }}
                            </div>
                        @endif
                    </div>
                </a>
                
                @auth
                    @if($product->stock > 0)
                    <div class="px-4 md:px-6 pb-4 md:pb-6">
                        <form action="{{ route('cart.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="w-full bg-gradient-to-r from-accent-600 to-orange-600 hover:from-accent-700 hover:to-orange-700 text-white py-2.5 md:py-3.5 px-4 md:px-6 rounded-xl font-bold shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-300 flex items-center justify-center text-sm md:text-base">
                                <svg class="w-4 h-4 md:w-5 md:h-5 mr-1 md:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span class="hidden sm:inline">{{ __('messages.add_to_cart') }}</span>
                                <span class="sm:hidden">Savatga</span>
                            </button>
                        </form>
                    </div>
                    @endif
                @endauth
            </div>
            @endforeach
        </div>
    </div>
    @endif

    @if($products->count() > 0)
    <div>
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-6 md:mb-8 text-gray-900 dark:text-white flex items-center">
            <span class="bg-gradient-to-r from-primary-600 via-secondary-600 to-accent-600 dark:from-primary-400 dark:via-secondary-400 dark:to-accent-400 bg-clip-text text-transparent">
                <span class="hidden sm:inline">{{ __('messages.all') }} {{ __('messages.products') }}</span>
                <span class="sm:hidden">{{ __('messages.products') }}</span>
            </span>
            <div class="ml-3 md:ml-4 h-1 flex-1 bg-gradient-to-r from-primary-200 via-secondary-200 to-transparent dark:from-primary-800 dark:via-secondary-800 rounded-full"></div>
        </h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
            <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-2xl border-2 border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:-translate-y-2">
                <a href="{{ route('products.show', $product) }}" class="block">
                    @if($product->image)
                        <div class="relative overflow-hidden h-56">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-black/0 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                    @else
                        <div class="h-56 bg-gradient-to-br from-blue-100 via-purple-100 to-pink-100 dark:from-gray-700 dark:via-gray-700 dark:to-gray-600 flex items-center justify-center">
                            <svg class="w-20 h-20 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                    
                    <div class="p-4 md:p-6">
                        <h3 class="font-bold text-lg md:text-xl mb-2 md:mb-3 text-gray-900 dark:text-white line-clamp-2 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">
                            {{ $product->name }}
                        </h3>
                        
                        <div class="flex items-center text-gray-700 dark:text-gray-300 text-xs md:text-sm mb-2 md:mb-3">
                            <svg class="w-3 h-3 md:w-4 md:h-4 mr-1 md:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            <span class="font-semibold">{{ $product->category->name }}</span>
                        </div>
                        
                        <div class="mb-3 md:mb-4">
                            <p class="text-2xl md:text-3xl font-bold text-primary-600 dark:text-primary-400">
                                {{ number_format($product->price, 0, ',', ' ') }}
                                <span class="text-xs md:text-sm font-normal text-gray-600 dark:text-gray-400">{{ __('messages.currency') }}</span>
                            </p>
                        </div>
                        
                        @if($product->stock > 0)
                            <div class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-400">
                                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                {{ __('messages.in_stock', ['count' => $product->stock]) }}
                            </div>
                        @else
                            <div class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-400">
                                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                {{ __('messages.out_of_stock') }}
                            </div>
                        @endif
                    </div>
                </a>
                
                @auth
                    @if($product->stock > 0)
                    <div class="px-4 md:px-6 pb-4 md:pb-6">
                        <form action="{{ route('cart.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="w-full bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 text-white py-2.5 md:py-3.5 px-4 md:px-6 rounded-xl font-bold shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-300 flex items-center justify-center text-sm md:text-base">
                                <svg class="w-4 h-4 md:w-5 md:h-5 mr-1 md:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span class="hidden sm:inline">{{ __('messages.add_to_cart') }}</span>
                                <span class="sm:hidden">Savatga</span>
                            </button>
                        </form>
                    </div>
                    @endif
                @endauth
            </div>
            @endforeach
        </div>
        
        <div class="mt-12">
            {{ $products->links() }}
        </div>
    </div>
    @else
    <div class="text-center py-12 md:py-20 bg-white dark:bg-gray-800 rounded-2xl md:rounded-3xl shadow-lg border-2 border-gray-100 dark:border-gray-700">
        <svg class="mx-auto h-16 w-16 md:h-20 md:w-20 text-gray-400 dark:text-gray-500 mb-4 md:mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
        </svg>
        <p class="text-gray-600 dark:text-gray-400 text-lg md:text-2xl font-semibold">{{ __('messages.no_products') }}</p>
    </div>
    @endif
</div>
@endsection
