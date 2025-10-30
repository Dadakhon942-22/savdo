@extends('layouts.app')

@section('title', $category->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Kategoriya header -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="flex items-center">
            <a href="{{ route('categories.index') }}" class="text-blue-600 hover:text-blue-800 mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <div class="flex-1">
                <h1 class="text-3xl font-bold">{{ $category->name }}</h1>
                @if($category->description)
                    <p class="text-gray-600 mt-2">{{ $category->description }}</p>
                @endif
                <p class="text-sm text-gray-500 mt-1">{{ $products->total() }} {{ __('messages.products') }}</p>
            </div>
        </div>
    </div>

    @if($products->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($products as $product)
        <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
            <a href="{{ route('products.show', $product) }}">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                @endif
                <div class="p-4">
                    <h3 class="font-semibold text-lg mb-2 line-clamp-2">{{ $product->name }}</h3>
                    @if($product->shop)
                        <p class="text-xs text-gray-500 mb-2">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            {{ $product->shop->name }}
                        </p>
                    @endif
                    <p class="text-blue-600 font-bold text-xl mb-2">{{ number_format($product->price, 0, ',', ' ') }} {{ __('messages.currency') }}</p>
                    @if($product->stock > 0)
                        <span class="text-green-600 text-sm">{{ __('messages.in_stock', ['count' => $product->stock]) }}</span>
                    @else
                        <span class="text-red-600 text-sm">{{ __('messages.out_of_stock') }}</span>
                    @endif
                </div>
            </a>
            @auth
                @if($product->stock > 0)
                <form action="{{ route('cart.store') }}" method="POST" class="p-4 pt-0">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                        {{ __('messages.add_to_cart') }}
                    </button>
                </form>
                @endif
            @else
                <div class="p-4 pt-0">
                    <a href="{{ route('login') }}" class="block w-full bg-gray-300 text-gray-700 py-2 rounded hover:bg-gray-400 text-center transition">
                        {{ __('messages.login') }}
                    </a>
                </div>
            @endauth
        </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $products->links() }}
    </div>
    @else
    <div class="text-center py-12 bg-white rounded-lg shadow">
        <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
        </svg>
        <p class="text-gray-500 text-lg">{{ __('messages.no_products') }}</p>
    </div>
    @endif
</div>
@endsection




