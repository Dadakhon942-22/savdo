@extends('layouts.app')

@section('title', $product->localized_name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Back Link -->
    <div class="relative mb-6 md:mb-8">
        <div class="absolute inset-0 bg-gradient-to-r from-primary-500 via-secondary-500 to-accent-500 rounded-xl transform rotate-[-0.5deg] opacity-10 blur-sm"></div>
        <a href="{{ route('products.index') }}" class="relative inline-flex items-center bg-gradient-to-r from-primary-50 via-secondary-50 to-accent-50 dark:from-primary-900/30 dark:via-secondary-900/30 dark:to-accent-900/30 hover:from-primary-100 hover:via-secondary-100 hover:to-accent-100 dark:hover:from-primary-900/50 dark:hover:via-secondary-900/50 dark:hover:to-accent-900/50 text-slate-900 dark:text-white hover:text-slate-800 dark:hover:text-gray-100 font-extrabold px-4 py-3 md:px-6 md:py-4 rounded-xl border-2 border-primary-200 dark:border-primary-700 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 mb-6">
            <svg class="w-5 h-5 md:w-6 md:h-6 mr-2 md:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span class="text-base md:text-lg">{{ __('messages.back') }}</span>
        </a>
    </div>

    <!-- Pastki oyna -->
    <div class="relative mb-8 md:mb-12">
        <div class="absolute inset-0 bg-gradient-to-br from-primary-600 via-secondary-600 to-accent-600 rounded-3xl transform rotate-[-1deg] opacity-20 blur-md"></div>
        
        <!-- Asosiy oyna -->
        <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl overflow-hidden border-2 border-gray-200 dark:border-gray-700">
            <div class="md:flex">
                <!-- Rasm bo'limi -->
                <div class="md:w-1/2 relative">
                    @if($product->image)
                        <div class="w-full h-96 md:h-[600px] bg-gradient-to-br from-gray-100 via-gray-50 to-white dark:from-gray-700 dark:via-gray-800 dark:to-gray-900 flex items-center justify-center p-4 md:p-8">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->localized_name }}" class="max-w-full max-h-full object-contain">
                        </div>
                    @else
                        <div class="w-full h-96 md:h-[600px] bg-gradient-to-br from-primary-500 via-secondary-500 to-accent-500 flex items-center justify-center">
                            <svg class="w-32 h-32 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                    
                    @if($product->is_on_sale && $product->discount_percentage > 0)
                        <div class="absolute top-4 right-4 bg-gradient-to-r from-orange-600 via-red-600 to-pink-600 text-white px-5 py-3 rounded-2xl font-extrabold text-2xl md:text-3xl shadow-2xl transform rotate-3 border-2 border-white/30">
                            -{{ number_format($product->discount_percentage, 0) }}%
                        </div>
                    @endif
                </div>
                
                <!-- Ma'lumotlar bo'limi -->
                <div class="md:w-1/2 p-6 md:p-8 lg:p-12 bg-gradient-to-br from-gray-50 via-white to-gray-50 dark:from-gray-800 dark:via-gray-900 dark:to-gray-800">
                    <!-- Mahsulot nomi -->
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white mb-4 bg-gradient-to-r from-primary-600 via-secondary-600 to-accent-600 dark:from-primary-400 dark:via-secondary-400 dark:to-accent-400 bg-clip-text text-transparent">
                        {{ $product->localized_name }}
                    </h1>
                    
                    <!-- Kategoriya -->
                    <div class="flex items-center mb-6">
                        <div class="px-3 py-1.5 bg-gradient-to-r from-indigo-100 to-purple-100 dark:from-indigo-900/40 dark:to-purple-900/40 rounded-xl border-2 border-indigo-200 dark:border-indigo-700">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                <p class="text-base md:text-lg font-extrabold text-indigo-700 dark:text-indigo-300">{{ $product->category->localized_name }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Narx bo'limi -->
                    <div class="relative mb-8">
                        <div class="absolute inset-0 bg-gradient-to-br from-emerald-400 via-teal-400 to-green-400 rounded-2xl transform rotate-[-0.5deg] opacity-10 blur-sm"></div>
                        <div class="relative bg-gradient-to-br from-emerald-50 via-teal-50 to-green-50 dark:from-emerald-900/30 dark:via-teal-900/30 dark:to-green-900/30 p-6 rounded-xl border-2 border-emerald-200 dark:border-emerald-700">
                            @if($product->is_on_sale && $product->discount_percentage > 0)
                                <p class="text-lg md:text-xl text-slate-500 dark:text-slate-400 line-through font-extrabold mb-2">
                                    {{ number_format($product->price, 0, ',', ' ') }} {{ __('messages.currency') }}
                                </p>
                                <p class="text-4xl md:text-5xl lg:text-6xl font-extrabold bg-gradient-to-r from-emerald-600 via-teal-600 to-green-600 dark:from-emerald-400 dark:via-teal-400 dark:to-green-400 bg-clip-text text-transparent mb-3">
                                    {{ number_format($product->discounted_price, 0, ',', ' ') }} {{ __('messages.currency') }}
                                </p>
                                <div class="flex items-center text-emerald-600 dark:text-emerald-400 font-extrabold text-lg md:text-xl">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ number_format($product->discount_amount, 0, ',', ' ') }} {{ __('messages.currency') }} {{ __('messages.save_money') }}!
                                </div>
                            @else
                                <p class="text-4xl md:text-5xl lg:text-6xl font-extrabold bg-gradient-to-r from-emerald-600 via-teal-600 to-green-600 dark:from-emerald-400 dark:via-teal-400 dark:to-green-400 bg-clip-text text-transparent">
                                    {{ number_format($product->price, 0, ',', ' ') }} {{ __('messages.currency') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Omborda holati -->
                    @if($product->stock > 0)
                        <div class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-emerald-100 to-green-100 dark:from-emerald-900/40 dark:to-green-900/40 text-emerald-800 dark:text-emerald-300 rounded-xl font-extrabold text-base md:text-lg mb-8 border-2 border-emerald-300 dark:border-emerald-600 shadow-md">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            {{ __('messages.in_stock', ['count' => $product->stock]) }}
                        </div>
                    @else
                        <div class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-rose-100 to-red-100 dark:from-rose-900/40 dark:to-red-900/40 text-rose-800 dark:text-rose-300 rounded-xl font-extrabold text-base md:text-lg mb-8 border-2 border-rose-300 dark:border-rose-600 shadow-md">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            {{ __('messages.out_of_stock') }}
                        </div>
                    @endif

                    <!-- Tavsif -->
                    @if($product->localized_description)
                    <div class="relative mb-8">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-400 via-purple-400 to-pink-400 rounded-2xl transform rotate-[-0.5deg] opacity-10 blur-sm"></div>
                        <div class="relative bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 dark:from-indigo-900/30 dark:via-purple-900/30 dark:to-pink-900/30 p-6 md:p-8 rounded-xl border-2 border-indigo-200 dark:border-indigo-700 shadow-lg">
                            <h2 class="text-xl md:text-2xl lg:text-3xl font-extrabold text-slate-900 dark:text-white mb-5 md:mb-6 flex items-center">
                                <svg class="w-6 h-6 md:w-7 md:h-7 mr-2 md:mr-3 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <span class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 dark:from-indigo-400 dark:via-purple-400 dark:to-pink-400 bg-clip-text text-transparent">
                                    {{ __('messages.description') }}
                                </span>
                            </h2>
                            <div class="bg-white dark:bg-gray-800/80 rounded-xl p-4 md:p-6 border border-indigo-100 dark:border-indigo-800 shadow-md">
                                <p class="text-slate-800 dark:text-slate-100 leading-relaxed md:leading-loose font-semibold text-base md:text-lg lg:text-xl whitespace-pre-line">{{ $product->localized_description }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Savatga qo'shish formasi -->
                    @auth
                        @if($product->stock > 0)
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-br from-primary-400 via-secondary-400 to-accent-400 rounded-2xl transform rotate-[-0.5deg] opacity-10 blur-sm"></div>
                            <form action="{{ route('cart.store') }}" method="POST" class="relative bg-gradient-to-br from-primary-50 via-secondary-50 to-accent-50 dark:from-gray-900 dark:to-gray-800 p-6 md:p-8 rounded-xl border-2 border-primary-200 dark:border-primary-700 shadow-xl">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="mb-6">
                                    <label for="quantity" class="block text-slate-900 dark:text-white font-extrabold mb-3 text-lg md:text-xl">{{ __('messages.quantity') }}:</label>
                                    <div class="flex items-center">
                                        <button type="button" onclick="decreaseQuantity()" class="px-4 py-3 bg-white dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 rounded-l-xl text-slate-900 dark:text-white font-extrabold hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                            </svg>
                                        </button>
                                        <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-24 md:w-32 border-2 border-gray-300 dark:border-gray-600 border-x-0 rounded-none px-4 py-3 text-center text-lg md:text-xl font-extrabold text-slate-900 dark:text-white bg-white dark:bg-gray-700 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                        <button type="button" onclick="increaseQuantity()" class="px-4 py-3 bg-white dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 rounded-r-xl text-slate-900 dark:text-white font-extrabold hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <button type="submit" class="w-full bg-gradient-to-r from-emerald-600 via-teal-600 to-green-600 hover:from-emerald-700 hover:via-teal-700 hover:to-green-700 text-white px-8 py-4 md:py-5 rounded-xl font-extrabold text-lg md:text-xl shadow-2xl hover:shadow-3xl transform hover:scale-[1.02] transition-all duration-300 flex items-center justify-center border-2 border-emerald-500/30">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    {{ __('messages.add_to_cart') }}
                                </button>
                            </form>
                        </div>
                        
                        <script>
                            function increaseQuantity() {
                                const input = document.getElementById('quantity');
                                const max = parseInt(input.getAttribute('max'));
                                const current = parseInt(input.value);
                                if (current < max) {
                                    input.value = current + 1;
                                }
                            }
                            
                            function decreaseQuantity() {
                                const input = document.getElementById('quantity');
                                const current = parseInt(input.value);
                                if (current > 1) {
                                    input.value = current - 1;
                                }
                            }
                        </script>
                        @else
                        <button disabled class="w-full bg-gradient-to-r from-gray-400 to-gray-500 text-white px-8 py-4 md:py-5 rounded-xl font-extrabold text-lg md:text-xl cursor-not-allowed border-2 border-gray-300 shadow-lg">
                            {{ __('messages.out_of_stock') }}
                        </button>
                        @endif
                    @else
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/30 dark:to-indigo-900/30 p-6 rounded-xl border-2 border-blue-200 dark:border-blue-700 shadow-lg">
                            <p class="text-slate-900 dark:text-white font-extrabold text-base md:text-lg">
                                {!! __('messages.login_to_add', ['login' => '<a href="'.route('login').'" class="text-primary-600 dark:text-primary-400 hover:underline font-extrabold">'.__('messages.login').'</a>']) !!}
                            </p>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Shunga o'xshash mahsulotlar -->
    @if($relatedProducts->count() > 0)
    <div class="mt-12 md:mt-16">
        <div class="relative mb-8">
            <div class="absolute inset-0 bg-gradient-to-r from-primary-500 via-secondary-500 to-accent-500 rounded-2xl transform rotate-[-1deg] opacity-10 blur-sm"></div>
            <div class="relative">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white mb-2 bg-gradient-to-r from-primary-600 via-secondary-600 to-accent-600 dark:from-primary-400 dark:via-secondary-400 dark:to-accent-400 bg-clip-text text-transparent">
                    {{ __('messages.similar_products') }}
                </h2>
                <div class="h-1 w-32 bg-gradient-to-r from-primary-600 via-secondary-600 to-accent-600 rounded-full"></div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($relatedProducts as $relatedProduct)
            <div class="group relative">
                <!-- Pastki oyna (3D effect) -->
                <div class="absolute inset-0 bg-gradient-to-br from-primary-500 via-secondary-500 to-accent-500 rounded-2xl transform rotate-[-2deg] opacity-20 group-hover:opacity-30 transition-all duration-300 group-hover:rotate-[-3deg] blur-sm -z-10 pointer-events-none"></div>
                
                <!-- Asosiy oyna -->
                <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:scale-105 border-2 border-gray-200 dark:border-gray-700">
                    <a href="{{ route('products.show', $relatedProduct) }}">
                        @if($relatedProduct->image)
                            <div class="w-full h-48 bg-gradient-to-br from-gray-100 via-gray-50 to-white dark:from-gray-700 dark:via-gray-800 dark:to-gray-900 flex items-center justify-center">
                                <img src="{{ asset('storage/' . $relatedProduct->image) }}" alt="{{ $relatedProduct->localized_name }}" class="max-w-full max-h-full object-contain p-2 group-hover:scale-105 transition-transform duration-500">
                            </div>
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-primary-500 via-secondary-500 to-accent-500 flex items-center justify-center">
                                <svg class="w-20 h-20 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                        <div class="p-4">
                            <h3 class="font-extrabold text-lg mb-2 text-slate-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors line-clamp-2">{{ $relatedProduct->localized_name }}</h3>
                            <p class="text-emerald-600 dark:text-emerald-400 font-extrabold text-xl">{{ number_format($relatedProduct->price, 0, ',', ' ') }} {{ __('messages.currency') }}</p>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
