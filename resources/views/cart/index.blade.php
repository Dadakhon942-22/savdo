@extends('layouts.app')

@section('title', __('messages.cart'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Hero Section -->
    <div class="relative mb-8 md:mb-12">
        <!-- Pastki oyna -->
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-600 via-teal-600 to-green-600 rounded-3xl transform rotate-[-1deg] opacity-20 blur-md"></div>
        
        <!-- Asosiy oyna -->
        <div class="relative text-center py-8 md:py-12 px-4 md:px-6 rounded-2xl md:rounded-3xl bg-gradient-to-br from-emerald-50 via-teal-50 to-green-50 dark:from-emerald-900/30 dark:via-teal-900/30 dark:to-green-900/30 border-2 border-emerald-200 dark:border-emerald-700 shadow-xl">
            <div class="relative z-10">
                <div class="inline-block mb-4 transform hover:scale-110 transition-transform duration-300">
                    <svg class="w-16 h-16 md:w-20 md:h-20 text-emerald-600 dark:text-emerald-400 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold mb-3 md:mb-4 bg-gradient-to-r from-emerald-600 via-teal-600 to-green-600 dark:from-emerald-400 dark:via-teal-400 dark:to-green-400 bg-clip-text text-transparent drop-shadow-sm">
                    🛒 {{ __('messages.cart') }}
                </h1>
                <p class="text-base md:text-xl text-slate-700 dark:text-slate-300 font-bold">{{ __('messages.order_summary') }}</p>
            </div>
        </div>
    </div>

    @if($cartItems->count() > 0)
    <!-- Pastki oyna -->
    <div class="relative mb-8">
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-500 via-teal-500 to-green-500 rounded-3xl transform rotate-[-1deg] opacity-10 blur-md"></div>
        
        <!-- Asosiy oyna -->
        <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl overflow-hidden border-2 border-gray-200 dark:border-gray-700">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gradient-to-r from-emerald-100 to-teal-100 dark:from-emerald-900/40 dark:to-teal-900/40">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-slate-900 dark:text-white uppercase tracking-wider">{{ __('messages.products') }}</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-slate-900 dark:text-white uppercase tracking-wider">{{ __('messages.price') }}</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-slate-900 dark:text-white uppercase tracking-wider">{{ __('messages.quantity') }}</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-slate-900 dark:text-white uppercase tracking-wider">{{ __('messages.total') }}</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-slate-900 dark:text-white uppercase tracking-wider">{{ __('messages.action') }}</th>
                </tr>
            </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($cartItems as $item)
                        <tr class="hover:bg-emerald-50 dark:hover:bg-emerald-900/10 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            @if($item->product->image)
                                        <div class="h-20 w-20 bg-gradient-to-br from-gray-100 via-gray-50 to-white dark:from-gray-700 dark:via-gray-800 dark:to-gray-900 rounded-xl border-2 border-emerald-200 dark:border-emerald-700 shadow-md flex items-center justify-center p-1">
                                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->localized_name }}" class="max-w-full max-h-full object-contain">
                                        </div>
                            @else
                                        <div class="h-20 w-20 bg-gradient-to-br from-emerald-500 via-teal-500 to-green-500 rounded-xl flex items-center justify-center shadow-md">
                                            <svg class="w-10 h-10 text-white opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                </div>
                            @endif
                            <div class="ml-4">
                                        <div class="text-base font-extrabold text-slate-900 dark:text-white">{{ $item->product->localized_name }}</div>
                                        <div class="text-sm font-bold text-indigo-700 dark:text-indigo-300">{{ $item->product->category->localized_name }}</div>
                            </div>
                        </div>
                    </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-base font-extrabold text-emerald-600 dark:text-emerald-400">{{ number_format($item->product->price, 0, ',', ' ') }} {{ __('messages.currency') }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center space-x-2">
                            @csrf
                            @method('PUT')
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" class="w-24 border-2 border-emerald-300 dark:border-emerald-600 rounded-lg px-3 py-2 text-slate-900 dark:text-white bg-white dark:bg-gray-700 font-extrabold focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                    <button type="submit" class="bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white px-3 py-2 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center gap-1.5 whitespace-nowrap">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        {{ __('messages.update') }}
                                    </button>
                        </form>
                    </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-lg font-extrabold text-slate-900 dark:text-white">{{ number_format($item->product->price * $item->quantity, 0, ',', ' ') }} {{ __('messages.currency') }}</span>
                    </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{ route('cart.destroy', $item->id) }}" method="POST" onsubmit="return confirm('{{ __('messages.confirm_delete') }}')">
                            @csrf
                            @method('DELETE')
                                    <button type="submit" class="bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 text-white px-3 py-2 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center gap-1.5 whitespace-nowrap">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        {{ __('messages.delete') }}
                                    </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
            </div>

            <div class="bg-gradient-to-r from-emerald-100 to-teal-100 dark:from-emerald-900/40 dark:to-teal-900/40 px-8 py-6 border-t-2 border-emerald-200 dark:border-emerald-700">
            <div class="flex justify-between items-center">
                    <span class="text-2xl font-extrabold text-slate-900 dark:text-white">{{ __('messages.total') }}:</span>
                    <span class="text-3xl font-extrabold text-emerald-600 dark:text-emerald-400">{{ number_format($total, 0, ',', ' ') }} {{ __('messages.currency') }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="flex gap-4">
        <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-r from-primary-500 via-secondary-500 to-accent-500 rounded-xl transform rotate-[-0.5deg] opacity-10 blur-sm"></div>
            <a href="{{ route('products.index') }}" class="relative inline-flex items-center bg-gradient-to-r from-primary-50 via-secondary-50 to-accent-50 dark:from-primary-900/30 dark:via-secondary-900/30 dark:to-accent-900/30 hover:from-primary-100 hover:via-secondary-100 hover:to-accent-100 dark:hover:from-primary-900/50 dark:hover:via-secondary-900/50 dark:hover:to-accent-900/50 text-slate-900 dark:text-white hover:text-slate-800 dark:hover:text-gray-100 font-extrabold px-6 py-4 rounded-xl border-2 border-primary-200 dark:border-primary-700 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                {{ __('messages.back') }}
            </a>
        </div>
        <a href="{{ route('orders.create') }}" class="flex-1 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white px-8 py-4 rounded-xl font-extrabold text-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 text-center border-2 border-emerald-500/30">
            {{ __('messages.checkout') }} →
        </a>
    </div>
    @else
    <!-- Pastki oyna -->
    <div class="relative">
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-500 via-teal-500 to-green-500 rounded-3xl transform rotate-[-1deg] opacity-10 blur-md"></div>
        
        <!-- Asosiy oyna -->
        <div class="relative text-center py-20 bg-white dark:bg-gray-800 rounded-xl shadow-2xl border-2 border-emerald-200 dark:border-emerald-700">
            <svg class="w-28 h-28 mx-auto text-emerald-400 dark:text-emerald-500 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <p class="text-2xl font-extrabold text-slate-700 dark:text-slate-300 mb-4">{{ __('messages.empty_cart') }}</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white px-8 py-4 rounded-xl font-extrabold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                {{ __('messages.products') }}
            </a>
        </div>
    </div>
    @endif
</div>
@endsection
