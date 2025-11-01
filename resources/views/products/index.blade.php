@extends('layouts.app')

@section('title', __('messages.products'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white mb-3">{{ __('messages.products') }}</h1>
        <p class="text-xl text-gray-700 dark:text-gray-300">{{ __('messages.all') }} {{ __('messages.products') }}</p>
    </div>

    <div class="flex flex-col md:flex-row gap-8">
        <!-- Sidebar -->
        <aside class="md:w-1/4">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border-2 border-gray-200 dark:border-gray-700 sticky top-24">
                <h2 class="text-xl font-extrabold text-gray-900 dark:text-white mb-4">{{ __('messages.search') }}</h2>
                <form action="{{ route('products.index') }}" method="GET">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('messages.search_placeholder') }}" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 mb-4 text-gray-900 dark:text-white bg-white dark:bg-gray-700 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 font-medium">
                    <button type="submit" class="w-full bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 text-white py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300">{{ __('messages.search') }}</button>
                </form>

                <h2 class="text-xl font-extrabold text-gray-900 dark:text-white mb-4 mt-8">{{ __('messages.categories') }}</h2>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('products.index') }}" class="block px-4 py-2 rounded-lg text-gray-900 dark:text-white font-semibold hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400 transition-colors {{ !request('category') ? 'bg-primary-100 dark:bg-primary-900/40 text-primary-700 dark:text-primary-300' : '' }}">
                            {{ __('messages.all') }}
                        </a>
                    </li>
                    @foreach($categories as $category)
                    <li>
                        <a href="{{ route('products.index', ['category' => $category->id]) }}" class="block px-4 py-2 rounded-lg text-gray-700 dark:text-gray-300 font-semibold hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400 transition-colors {{ request('category') == $category->id ? 'bg-primary-100 dark:bg-primary-900/40 text-primary-700 dark:text-primary-300' : '' }}">
                            {{ $category->localized_name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        <!-- Products Grid -->
        <div class="md:w-3/4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($products as $product)
                <div class="group relative bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:scale-105 border-2 border-gray-200 dark:border-gray-700">
                    <a href="{{ route('products.show', $product) }}">
                        @if($product->image)
                            <div class="w-full h-48 bg-gradient-to-br from-gray-100 via-gray-50 to-white dark:from-gray-700 dark:via-gray-800 dark:to-gray-900 flex items-center justify-center">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->localized_name }}" class="max-w-full max-h-full object-contain p-2 group-hover:scale-105 transition-transform duration-500">
                            </div>
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-primary-500 via-secondary-500 to-accent-500 flex items-center justify-center">
                                <svg class="w-20 h-20 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-2 text-gray-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors line-clamp-2">{{ $product->localized_name }}</h3>
                            <p class="text-gray-700 dark:text-gray-300 text-sm mb-2 font-medium">{{ $product->category->localized_name }}</p>
                            <p class="text-primary-600 dark:text-primary-400 font-extrabold text-xl mb-2">{{ number_format($product->price, 0, ',', ' ') }} {{ __('messages.currency') }}</p>
                            @if($product->stock > 0)
                                <span class="inline-flex items-center px-2 py-1 bg-green-100 dark:bg-green-900/40 text-green-800 dark:text-green-300 rounded-lg text-xs font-bold">
                                    {{ __('messages.in_stock', ['count' => $product->stock]) }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 bg-red-100 dark:bg-red-900/40 text-red-800 dark:text-red-300 rounded-lg text-xs font-bold">
                                    {{ __('messages.out_of_stock') }}
                                </span>
                            @endif
                        </div>
                    </a>
                    @auth
                        @if($product->stock > 0)
                        <form action="{{ route('cart.store') }}" method="POST" class="p-4 pt-0">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="w-full bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 text-white py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                {{ __('messages.add_to_cart') }}
                            </button>
                        </form>
                        @endif
                    @endauth
                </div>
                @empty
                <div class="col-span-full text-center py-16 bg-white dark:bg-gray-800 rounded-xl shadow-lg border-2 border-gray-200 dark:border-gray-700">
                    <svg class="w-24 h-24 mx-auto text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <p class="text-xl font-bold text-gray-700 dark:text-gray-300">{{ __('messages.no_products') }}</p>
                </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
