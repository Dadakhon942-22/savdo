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

    <!-- Aksiyalar Bo'limi (Modal Trigger) -->
    @if(isset($saleProducts) && $saleProducts->count() > 0)
    <div class="mb-12 md:mb-16">
        <button onclick="openPromotionsModal()" class="w-full group relative">
            <!-- Pastki oyna -->
            <div class="absolute inset-0 bg-gradient-to-r from-accent-500 via-orange-500 to-red-500 rounded-2xl transform rotate-[-1deg] opacity-20 group-hover:opacity-30 transition-all duration-300 blur-sm"></div>
            
            <!-- Asosiy oyna -->
            <div class="relative bg-gradient-to-r from-accent-600 via-orange-600 to-red-600 dark:from-accent-700 dark:via-orange-700 dark:to-red-700 rounded-2xl shadow-2xl p-8 md:p-12 overflow-hidden transform transition-all duration-500 group-hover:scale-[1.02] group-hover:shadow-3xl">
                <!-- Background pattern -->
                <div class="absolute inset-0 opacity-10">
                    <svg class="w-full h-full" viewBox="0 0 400 400" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                                <path d="M 40 0 L 0 0 0 40" fill="none" stroke="currentColor" stroke-width="1"/>
                            </pattern>
                        </defs>
                        <rect width="100%" height="100%" fill="url(#grid)" />
                    </svg>
                </div>
                
                <!-- Content -->
                <div class="relative z-10 text-center">
                    <div class="inline-block mb-4 transform group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-16 h-16 md:w-20 md:h-20 text-white animate-pulse" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.894 6.166a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.758 17.303a.75.75 0 00-1.061-1.06l-1.591 1.59a.75.75 0 001.06 1.061l1.591-1.59zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.697 7.757a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 00-1.061 1.06l1.59 1.591z"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white mb-4 group-hover:scale-105 transition-transform duration-300">
                        🔥 {{ __('messages.promotional_products') }}
                    </h2>
                    <p class="text-lg md:text-xl text-white/90 mb-6 font-semibold">
                        {{ $saleProducts->count() }} {{ __('messages.products') }} - {{ __('messages.save_money') }} {{ __('messages.do_it') }}
                    </p>
                    <div class="inline-flex items-center px-6 py-3 bg-white/20 backdrop-blur-lg rounded-xl text-white font-bold text-lg group-hover:bg-white/30 transition-all duration-300">
                        <span>{{ __('messages.view') }}</span>
                        <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
                
                <!-- Shine effect -->
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
            </div>
        </button>
    </div>
    
    <!-- Aksiyalar Modal -->
    <div id="promotions-modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden items-center justify-center p-4" onclick="closePromotionsModal(event)">
        <div class="relative bg-white dark:bg-gray-800 rounded-3xl shadow-2xl max-w-7xl w-full max-h-[90vh] overflow-hidden transform transition-all duration-300" onclick="event.stopPropagation()">
            <!-- Modal Header -->
            <div class="relative bg-gradient-to-r from-accent-600 via-orange-600 to-red-600 p-6 md:p-8">
                <button onclick="closePromotionsModal()" class="absolute top-4 right-4 p-2 bg-white/20 hover:bg-white/30 rounded-lg text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                <h2 class="text-3xl md:text-4xl font-bold text-white text-center">
                    🔥 {{ __('messages.promotional_products') }}
                </h2>
                <p class="text-center text-white/90 mt-2">{{ $saleProducts->count() }} {{ __('messages.products') }}</p>
            </div>
            
            <!-- Modal Content -->
            <div class="p-6 md:p-8 overflow-y-auto max-h-[calc(90vh-150px)]">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8" data-grid-responsive>
            @foreach($saleProducts as $product)
            <div class="group relative w-full h-full">
                <!-- Pastki oyna (3D effect) -->
                <div class="absolute inset-0 bg-gradient-to-br from-accent-600 via-orange-600 to-red-600 rounded-2xl transform rotate-[-2deg] opacity-30 group-hover:opacity-40 transition-all duration-300 group-hover:rotate-[-3deg] blur-sm -z-10 pointer-events-none"></div>
                <div class="absolute inset-0 bg-gradient-to-br from-accent-500 via-orange-500 to-red-500 rounded-2xl transform rotate-[-1deg] opacity-20 group-hover:opacity-30 transition-all duration-300 group-hover:rotate-[-2deg] blur-xs -z-20 pointer-events-none"></div>
                
                <!-- Asosiy oyna (yuqorida) -->
                <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl hover:shadow-3xl border-2 border-accent-200 dark:border-accent-700 overflow-hidden transform transition-all duration-500 group-hover:scale-105 group-hover:-translate-y-2 h-full flex flex-col">
                <!-- Chegirma badge -->
                <div class="absolute top-2 right-2 md:top-3 md:right-3 z-10 bg-gradient-to-br from-accent-500 to-red-500 text-white px-2 py-1 md:px-3 md:py-2 rounded-lg md:rounded-xl font-bold text-sm md:text-lg shadow-xl transform rotate-3">
                    -{{ number_format($product->discount_percentage, 0) }}%
                </div>
                
                <a href="{{ route('products.show', $product) }}" class="block">
                    @if($product->image)
                        <div class="relative overflow-hidden h-56 bg-gradient-to-br from-gray-100 via-gray-50 to-white dark:from-gray-700 dark:via-gray-800 dark:to-gray-900 flex items-center justify-center">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->localized_name }}" class="max-w-full max-h-full object-contain p-2 group-hover:scale-105 transition-transform duration-500">
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
                        <h3 class="font-extrabold text-lg md:text-xl mb-2 md:mb-3 text-slate-900 dark:text-slate-100 line-clamp-2 group-hover:text-orange-600 dark:group-hover:text-orange-400 transition-colors">
                            {{ $product->localized_name }}
                        </h3>
                        
                        <div class="flex items-center text-violet-700 dark:text-violet-300 text-xs md:text-sm mb-2 md:mb-3 font-bold">
                            <svg class="w-3 h-3 md:w-4 md:h-4 mr-1 md:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            <span class="font-extrabold">{{ $product->category->localized_name }}</span>
                        </div>
                        
                        <div class="mb-3 md:mb-4">
                            <!-- Eski narx (chizilgan) -->
                            <p class="text-sm md:text-base text-slate-500 dark:text-slate-400 line-through font-bold">
                                {{ number_format($product->price, 0, ',', ' ') }} {{ __('messages.currency') }}
                            </p>
                            <!-- Yangi narx (chegirmadagi) -->
                            <p class="text-2xl md:text-3xl font-extrabold text-orange-600 dark:text-orange-400">
                                {{ number_format($product->discounted_price, 0, ',', ' ') }}
                                <span class="text-xs md:text-sm font-bold text-slate-600 dark:text-slate-400">{{ __('messages.currency') }}</span>
                            </p>
                            <p class="text-xs md:text-sm text-cyan-600 dark:text-cyan-400 font-extrabold mt-1">
                                💰 {{ number_format($product->discount_amount, 0, ',', ' ') }} {{ __('messages.currency') }} {{ __('messages.save_money') }}!
                            </p>
                        </div>
                        
                        @if($product->stock > 0)
                            <div class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-extrabold bg-emerald-100 dark:bg-emerald-900/50 text-emerald-800 dark:text-emerald-200 border-2 border-emerald-300 dark:border-emerald-600 shadow-md">
                                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                {{ __('messages.in_stock', ['count' => $product->stock]) }}
                            </div>
                        @else
                            <div class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-extrabold bg-rose-100 dark:bg-rose-900/50 text-rose-800 dark:text-rose-200 border-2 border-rose-300 dark:border-rose-600 shadow-md">
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
                            <button type="submit" class="w-full bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-700 hover:to-red-700 text-white py-2.5 md:py-3.5 px-4 md:px-6 rounded-xl font-extrabold shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-300 flex items-center justify-center text-sm md:text-base border-2 border-orange-500/30">
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
            </div>
            @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif

    <script>
        function openPromotionsModal() {
            document.getElementById('promotions-modal').classList.remove('hidden');
            document.getElementById('promotions-modal').classList.add('flex');
            document.body.style.overflow = 'hidden';
        }
        
        function closePromotionsModal(event) {
            if (event && event.target !== event.currentTarget) return;
            document.getElementById('promotions-modal').classList.add('hidden');
            document.getElementById('promotions-modal').classList.remove('flex');
            document.body.style.overflow = 'auto';
        }
        
        // ESC key bilan yopish
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePromotionsModal();
            }
        });
    </script>

    @if($products->count() > 0)
    <div>
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-6 md:mb-8 text-gray-900 dark:text-white flex items-center">
            <span class="bg-gradient-to-r from-primary-600 via-secondary-600 to-accent-600 dark:from-primary-400 dark:via-secondary-400 dark:to-accent-400 bg-clip-text text-transparent">
                <span class="hidden sm:inline">{{ __('messages.all') }} {{ __('messages.products') }}</span>
                <span class="sm:hidden">{{ __('messages.products') }}</span>
            </span>
            <div class="ml-3 md:ml-4 h-1 flex-1 bg-gradient-to-r from-primary-200 via-secondary-200 to-transparent dark:from-primary-800 dark:via-secondary-800 rounded-full"></div>
        </h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8 w-full" data-grid-responsive>
            @foreach($products as $product)
            <div class="group relative w-full h-full">
                <!-- Pastki oyna (3D effect) -->
                <div class="absolute inset-0 bg-gradient-to-br from-primary-500 via-secondary-500 to-accent-500 rounded-2xl transform rotate-[-2deg] opacity-20 group-hover:opacity-30 transition-all duration-300 group-hover:rotate-[-3deg] blur-sm -z-10 pointer-events-none"></div>
                <div class="absolute inset-0 bg-gradient-to-br from-primary-400 via-secondary-400 to-accent-400 rounded-2xl transform rotate-[-1deg] opacity-15 group-hover:opacity-25 transition-all duration-300 group-hover:rotate-[-2deg] blur-xs -z-20 pointer-events-none"></div>
                
                <!-- Asosiy oyna (yuqorida) -->
                <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl hover:shadow-3xl border-2 border-gray-100 dark:border-gray-700 overflow-hidden transform transition-all duration-500 group-hover:scale-105 group-hover:-translate-y-2 h-full flex flex-col">
                <a href="{{ route('products.show', $product) }}" class="block">
                    @if($product->image)
                        <div class="relative overflow-hidden h-56 bg-gradient-to-br from-gray-100 via-gray-50 to-white dark:from-gray-700 dark:via-gray-800 dark:to-gray-900">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->localized_name }}" class="w-full h-full object-contain p-2 group-hover:scale-105 transition-transform duration-500">
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
                        <h3 class="font-extrabold text-lg md:text-xl mb-2 md:mb-3 text-slate-900 dark:text-slate-100 line-clamp-2 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                            {{ $product->localized_name }}
                        </h3>
                        
                        <div class="flex items-center text-indigo-700 dark:text-indigo-300 text-xs md:text-sm mb-2 md:mb-3 font-bold">
                            <svg class="w-3 h-3 md:w-4 md:h-4 mr-1 md:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            <span class="font-extrabold">{{ $product->category->localized_name }}</span>
                        </div>
                        
                        <div class="mb-3 md:mb-4">
                            <p class="text-2xl md:text-3xl font-extrabold text-emerald-600 dark:text-emerald-400">
                                {{ number_format($product->price, 0, ',', ' ') }}
                                <span class="text-xs md:text-sm font-bold text-slate-600 dark:text-slate-400">{{ __('messages.currency') }}</span>
                            </p>
                        </div>
                        
                        @if($product->stock > 0)
                            <div class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-extrabold bg-emerald-100 dark:bg-emerald-900/50 text-emerald-800 dark:text-emerald-200 border-2 border-emerald-300 dark:border-emerald-600 shadow-md">
                                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                {{ __('messages.in_stock', ['count' => $product->stock]) }}
                            </div>
                        @else
                            <div class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-extrabold bg-rose-100 dark:bg-rose-900/50 text-rose-800 dark:text-rose-200 border-2 border-rose-300 dark:border-rose-600 shadow-md">
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
                            <button type="submit" class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white py-2.5 md:py-3.5 px-4 md:px-6 rounded-xl font-extrabold shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-300 flex items-center justify-center text-sm md:text-base border-2 border-emerald-500/30">
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
