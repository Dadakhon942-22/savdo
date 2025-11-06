@extends('layouts.app')

@section('title', __('messages.manage_products'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="relative mb-8 md:mb-12">
        <div class="absolute inset-0 bg-gradient-to-br from-green-500 via-emerald-500 to-teal-500 rounded-3xl transform rotate-[-1deg] opacity-20 blur-md"></div>
        <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-6 border-2 border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl md:text-3xl font-extrabold text-slate-900 dark:text-white">📦 {{ __('messages.products') }}</h2>
                <span class="text-3xl md:text-4xl font-extrabold text-green-600 dark:text-green-400">{{ $products->count() }}</span>
            </div>
            <a href="{{ route('seller.products.create') }}" class="block bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600 hover:from-green-700 hover:via-emerald-700 hover:to-teal-700 text-white px-6 py-4 rounded-xl text-center font-extrabold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02]">
                {{ __('messages.new_product') }}
            </a>
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

    <!-- Mahsulotlar ro'yxati -->
    @if($products->count() > 0)
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-6 border-2 border-gray-200 dark:border-gray-700">
        <div class="max-h-[600px] overflow-y-auto space-y-3 pr-2">
            @foreach($products as $product)
            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3 border border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                <div class="flex items-center gap-3">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->localized_name }}" class="w-16 h-16 object-cover rounded-lg border-2 border-gray-200 dark:border-gray-600">
                    @else
                        <div class="w-16 h-16 bg-gradient-to-br from-green-400 via-emerald-400 to-teal-400 rounded-lg flex items-center justify-center">
                            <svg class="w-8 h-8 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <h3 class="font-extrabold text-sm md:text-base text-gray-900 dark:text-white truncate">{{ $product->localized_name }}</h3>
                        <p class="text-xs md:text-sm text-gray-600 dark:text-gray-400 font-semibold">{{ $product->category->localized_name }}</p>
                        <p class="text-xs md:text-sm font-bold text-green-600 dark:text-green-400 mt-1">{{ number_format($product->price, 0, ',', ' ') }} {{ __('messages.currency') }}</p>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <a href="{{ route('seller.products.edit', $product) }}" class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 hover:from-blue-700 hover:via-indigo-700 hover:to-purple-700 text-white px-2.5 py-1.5 rounded-lg font-bold shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105 flex items-center gap-1 text-xs" title="{{ __('messages.edit') }}">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </a>
                        <form action="{{ route('seller.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('messages.confirm_delete') }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 text-white px-2.5 py-1.5 rounded-lg font-bold shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105 flex items-center gap-1 text-xs" title="{{ __('messages.delete') }}">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-12 border-2 border-gray-200 dark:border-gray-700 text-center">
        <p class="text-gray-600 dark:text-gray-400 text-lg font-semibold">{{ __('messages.no_products') }}</p>
        <a href="{{ route('seller.products.create') }}" class="inline-block mt-4 bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600 hover:from-green-700 hover:via-emerald-700 hover:to-teal-700 text-white px-6 py-3 rounded-xl font-extrabold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
            {{ __('messages.new_product') }}
        </a>
    </div>
    @endif
</div>
@endsection
